<?php

/**
 * Внешнее действие для создания баннера
 * Class FeedBannerAction
 */
class FeedBannerAction extends BaseAction
{
    /**
     * @var FeedBanner
     */
    private $model = null;

    public function run($id = null, $next = null)
    {
        parent::run($id, $next); # инициализируем юзера и контроллер
        $this->controller->layout = 'bootstrapCabinet';
        if (empty($id)) {
            $this->model = new FeedBanner();
            $date = new DateTime();
            $date->modify('+ 15 hours');
            $this->model->bannerPublishDates = array(
                array(
                    'publish_date' => $date->format('Y-m-d H:00:00')
                )
            );
            $this->model->user_id = $this->currentUser->id;
        } else {
            $this->model = FeedBanner::model()->findByPk($id);
            $this->model->bannerPublishDates = $this->model->banner2Date;
            if (!$this->checkAccess()) { # защита баннера от непрошенных гостей
                throw new CHttpException(403, Yii::t('main', 'Доступ на редактирование закрыт'));
            }
        }
        if (Yii::app()->request->isAjaxRequest) {
            if (in_array($this->action, array('save'))) {
                $this->json['error'] = $this->validate();

                if ($this->json['error'] == '[]') {
                    $this->save();
                } else {
                    $this->json['dialog_text'] = Yii::t('main', 'Пожалуйста, введите верные данные для создания объявления');
                }
                $this->json['scroll'] = 1;

            }
            $this->json['url'] = $this->getReturnUrl();
            $this->controller->renderJSON($this->json);
        }
        $this->controller->render('external.views.feedBanner.edit', array('model' => $this->model));
    }

    /**
     * @param $model
     */
    protected function validate()
    {
        $this->model->attributes = $_REQUEST[CHtml::modelName($this->model)];
        $this->model->usersShow = isset($_REQUEST['FeedBanner']['usersShow']) ? $_REQUEST['FeedBanner']['usersShow'] : array();
        $this->model->media_id = Yii::app()->request->getParam('logo_id', null);
        if ($this->model->isNewRecord) {
            $this->model->status = 'new';
        }
        $isValidate = CActiveForm::validate($this->model, null, false);

        if (empty($_REQUEST['banner2region'])) {
            Candy::pushJson($isValidate, 'FeedBanner_region_id', Yii::t('main', 'Не выбран не один регион'));
        }
        if (empty($_REQUEST['publishDate'])) {
             Candy::pushJson($isValidate, 'FeedBanner_bannerPublishDates', Yii::t('main', 'Не выбрана дата публикации'));
        } else {
            $publishArr = array();
            $now = new DateTime();
            foreach($_REQUEST['publishDate'] as $dateItem){
                if(empty($dateItem['date'])){
                    Candy::pushJson($isValidate, 'FeedBanner_bannerPublishDates', Yii::t('main', 'Дата публиции должна быть заполнена'));
                    break;
                }
                $hour = (int)$dateItem['hour'] > 10 ? (int)$dateItem['hour'] : "0" . (int)$dateItem['hour'];
                $publish = new DateTime("{$dateItem['date']} $hour:00:00");
                $publishArr[] = $publish;
                if($this->model->isNew()){ //or rejected
                    if ((int)$publish->format('U') - (int)$now->format('U') < 60 * 60 * 12) {
                        Candy::pushJson($isValidate, 'FeedBanner_bannerPublishDates', Yii::t('main', 'Дата публиции должна быть не раньше, чем через 12 часов после оплаты') . " (" . $publish->format('Y-m-d H:i:s') . ")");
                        break;
                    }
                }
            }
            foreach($publishArr as $key => $dateItem){
                foreach($publishArr as $keySecond => $dateItemSecond){
                    if($key == $keySecond){
                        continue;
                    }
                    if(abs((int)$dateItemSecond->format('U') - (int)$dateItem->format('U')) < 60 * 60 * 12){
                        Candy::pushJson($isValidate, 'FeedBanner_bannerPublishDates', Yii::t('main', 'Минимальный интервал публикации 12 часов') . " (" . $dateItem->format('Y-m-d H:i:s') . " & " . $dateItemSecond->format('Y-m-d H:i:s') . ")");
                        break;
                    }
                }
            }
            $this->model->bannerPublishDates = array();
            foreach($publishArr as $dateItem){
                $this->model->bannerPublishDates[] = array('publish_date' => $dateItem->format('Y-m-d H:i:s'));
            }
        }
        return $isValidate;
    }

    protected function save()
    {
        if($this->model->isNewRecord){
            if(!$this->model->pay($this->currentUser)){
                Candy::pushJson($this->json['error'], 'FeedBanner_media_id', Yii::t('main', 'У Вас не хватает средств на покупку объявления'));
                return false;
            }
        }
        if ($this->model->save()) {
            FeedBanner2Region::model()->manySave($_REQUEST['banner2region'], $this->model->id, 'banner_id', 'region_id');
           if ($this->action == 'save') {
                $this->model->moderate();
                $this->json['status'] = self::S_SUCCESS;
                $this->json['id'] = $this->model->id;
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
        if($this->model->isNew()){
            $html = CHtml::submitButton(Yii::t('main', 'Оплатить') . " (" . Setting::get(Setting::FEED_BANNER_PRICE) . " руб.)", array('class' => 'btn btn-success', 'id' => 'save-form'));
        } else {
            $html = CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class' => 'btn btn-success', 'id' => 'save-form'));
        }
        return $html;
    }
}