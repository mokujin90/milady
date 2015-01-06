<?php

/**
 * Внешнее действие для создания баннера
 * Class BannerAction
 */
class BannerAction extends BaseAction
{
    /**
     * @var Banner
     */
    private $model = null;

    public function run($id = null, $next = null)
    {
        parent::run($id, $next); # инициализируем юзера и контроллер

        if (empty($id)) {
            $this->model = new Banner();
            $this->model->balance = 0;
            $this->model->user_id = $this->currentUser->id;
        } else {
            $this->model = Banner::model()->findByPk($id);
            if (!$this->checkAccess()) { # защита баннера от непрошенных гостей
                throw new CHttpException(403, Yii::t('main', 'Доступ на редактирование закрыт'));
            }
        }
        if (Yii::app()->request->isAjaxRequest) {
            if ($this->action == 'investor') {
                $this->controller->renderPartial('external.views.banner._investorParam', array('model' => $this->model), false, true);
                Yii::app()->end();
            } elseif (in_array($this->action, array('recommend', 'save', 'pay'))) {
                $this->json['error'] = $this->validate();

                if ($this->json['error'] == '[]') {
                    if ($this->action == 'recommend') {
                        $countTargetUser = User::countTarget($_REQUEST);
                        $this->json['count'] = $countTargetUser . " " . Candy::getNumEnding($countTargetUser, array(Yii::t('main', 'человек'), Yii::t('main', 'человека'), Yii::t('main', 'человек')));
                        $this->json['price'] = $countTargetUser * 0.1;
                        $min = Setting::get($this->model->type == Banner::T_CLICK ? Setting::START_PRICE_CLICK : Setting::START_PRICE_VIEW);
                        $this->json['price'] = $this->json['price'] <= $min ? $min : $this->json['price'];
                        $this->controller->renderJSON($this->json);
                    } else if (in_array($this->action, array('save', 'pay'))) {
                        $this->save();
                    }
                } else {
                    $this->json['dialog_text'] = Yii::t('main', 'Пожалуйста, введите верные данные для создания банера');
                }
                $this->json['scroll'] = 1;

            }
            $this->json['url'] = $this->getReturnUrl();
            $this->controller->renderJSON($this->json);
        }
        $this->controller->render('external.views.banner.edit', array('model' => $this->model));
    }

    /**
     * @param $model
     */
    protected function validate()
    {
        $this->model->attributes = $_REQUEST[CHtml::modelName($this->model)];
        $this->model->usersShow = $_REQUEST['Banner']['usersShow'];
        $this->model->daysShow = $_REQUEST['Banner']['daysShow'];
        $this->model->media_id = Yii::app()->request->getParam('logo_id', null);
        if ($this->model->isNewRecord) {
            $this->model->status = 'new';
            $this->model->balance = $_REQUEST['Banner']['balance']; //временно занесем сюда
        }
        $isValidate = CActiveForm::validate($this->model, null, false);

        if (empty($_REQUEST['banner2region'])) {
            Candy::pushJson($isValidate, 'Banner_region_id', Yii::t('main', 'Не выбран не один регион'));
        }
        #инвесторы тоже есть
        if (in_array(User::T_INVESTOR, $this->model->usersShow)) {
            if (empty($_REQUEST['banner2country'])) {
                Candy::pushJson($isValidate, 'Banner_banner2country', Yii::t('main', 'Не выбран ни одна страна'));
            }
            if (empty($_REQUEST['banner2investorType'])) {
                Candy::pushJson($isValidate, 'Banner_banner2investorType', Yii::t('main', 'Не выбран ни один тип инвестора'));
            }
            if (empty($_REQUEST['banner2industry'])) {
                Candy::pushJson($isValidate, 'Banner_banner2industry', Yii::t('main', 'Не выбран ни одна отрасль'));
            }
        }
        if ($this->action == 'recommend') {
            Candy::unsetJsonKey($isValidate, 'Banner_price'); //сейчас еще рано о цене думать
            Candy::unsetJsonKey($isValidate, 'Banner_balance'); //сейчас еще рано о цене думать
        }

        return $isValidate;
    }

    protected function save()
    {
        $addValue = Yii::app()->request->getParam('add_value', '0');
        if($this->model->isNewRecord){

            if(!$this->model->balance >= Setting::get(Setting::MIN_BANNER_BALANCE)){
                Candy::pushJson($this->json['error'], 'Banner_balance', Yii::t('main', 'Укажите верную сумму'));
                return false;
            }
            if(!$this->model->addBalance($this->model->balance,$this->currentUser,true)){
                Candy::pushJson($this->json['error'], 'Banner_balance', Yii::t('main', 'У Вас не хватает средств на пополнение этой суммой'));
                return false;
            }
        }
        if ($this->model->save()) {

            Banner2Region::model()->manySave($_REQUEST['banner2region'], $this->model->id, 'banner_id', 'region_id');
            Banner2Country::model()->manySave($_REQUEST['banner2country'], $this->model->id, 'banner_id', 'country_id');
            Banner2InvestorType::model()->manySave($_REQUEST['banner2investorType'], $this->model->id, 'banner_id', 'type_id');
            Banner2Industry::model()->manySave($_REQUEST['banner2industry'], $this->model->id, 'banner_id', 'industry_id');
            if ($this->action == 'save') {
                $this->model->moderate();
                $this->json['status'] = self::S_SUCCESS;
                $this->json['id'] = $this->model->id;
            } elseif ($this->action == 'pay' && $addValue > 0) {
                $result = $this->model->addBalance($addValue,$this->currentUser);

                $this->json['status'] = $result ? self::S_SUCCESS : self::S_NO_MONEY;
                if(!$result){
                    $this->json['dialog_text'] = Yii::t('main','Извините, но у Вас не хватает средств');
                }
                else{
                    $this->json['balance'] = $this->model->balance;
                    $this->json['id'] = $this->model->id;
                }
            }

        }
    }

    /**
     * Подобие RBAC-метода checkAccess для проверки доступа к баннерам
     * @param $model
     */
    private function checkAccess()
    {
        return $this->model->user_id == Yii::app()->user->id;
    }

    private function getReturnUrl()
    {
        $url = $this->controller->createUrl('banner/index');
        return $url;
    }

    public function buttonPanel()
    {
        $html = CHtml::submitButton(Yii::t('main', 'Опубликовать'), array('class' => 'btn', 'id' => 'save-form'));
        if(!$this->model->isNew()){
            $html .= CHtml::link(Yii::t('main', 'Пополнить баланс баннера'), '#', array('class' => 'btn', 'id' => 'add_balance', 'data-sum' => Balance::get(Yii::app()->user->id)->value));
        }
        if ($this->model->status == "approved" && $this->model->is_blocked == 0) {
            $html .= CHtml::link(Yii::t('main', 'Заблокировать'), array('banner/block', 'id' => $this->model->id), array('class' => 'btn'));
        } elseif ($this->model->status == "approved" && $this->model->is_blocked == 1) {
            $html .= CHtml::link(Yii::t('main', 'Разблокировать'), array('banner/block', 'id' => $this->model->id), array('class' => 'btn'));

        }
        return $html;
    }
}