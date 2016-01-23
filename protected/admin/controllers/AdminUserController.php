<?php

class AdminUserController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'user';
        $this->pageCaption = 'Пользователи';
        $this->activeMenu = array('user', 'user-list');
        if(!$this->user->can('user')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new User('search');
        $model->unsetAttributes();
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id=null){
        $params = array();
        $model = is_null($id) ? new User() : $this->loadModel('User', null, $id);
        if (isset($_POST['User'])) {
            if($model->isNewRecord){
                $model->password = $_POST['User']['password'];
            }
            elseif (!empty($_POST['User']['password']) || !empty($_POST['User']['password_repeat'])) {
                $model->scenario = 'changeByAdminPassword';
            }
            else {
                $model->scenario = 'update';
            }
            $model->attributes = $_POST['User'];
            $model->logo_id = Yii::app()->request->getParam('logo_id') == "" ? null : Yii::app()->request->getParam('logo_id');
            if ($model->type == 'investor') {
                $model->investor_country_id = Candy::get($_POST['User']['investor_country_id'], null);
                $model->investor_type = Candy::get($_POST['User']['investor_type'], -1);
                $model->investor_industry = Candy::get($_POST['User']['investor_industry'], -1);
            }
            if ($model->save()) {
                if ($model->scenario == 'changeByAdminPassword') {
                    $params['dialog'] = Yii::t('main', 'Ваш пароль был успешно изменен.');
                }
                User2Region::model()->deleteAllByAttributes(array('user_id'=>$model->id));
                if(!empty($_REQUEST['user2region']) && is_array($_REQUEST['user2region'])){
                    foreach($_REQUEST['user2region'] as $item){
                        $user2region = new User2Region();
                        $user2region->attributes = array('region_id'=>$item,'user_id'=>$model->id);
                        @$user2region->save();
                    }
                }
            }
            if(is_null($id) && !$model->isNewRecord){#удачно сохранили
                $this->redirect('/admin/User/index');
            }

        }
        $this->render('edit',array('model' => $model, 'params' => $params));
    }

    public function actionHistory($id)
    {
        $data = BalanceHistory::findAllByUser($id);
        $user = User::model()->findByPk($id);
        $this->render('history', array('data' => $data,'user'=>$user));
    }

    /**
     * Вернуть платеж
     * @param $historyId
     */
    public function actionUnretention($id)
    {
        $model = BalanceHistory::model()->findByPk($id);
        if($model->object_type =='retention'){
            $model->delete();
            $balance = Balance::get($model->user_id);
            $balance->value += (-1)*$model->delta;
            $balance->save();
        }
        $this->redirect($this->createUrl('history',array('id'=>$model->user_id)));
    }

    public function actionAdd(){
        Balance::pay(Yii::app()->request->getParam('userId'),Yii::app()->request->getParam('cost'),'add',Yii::app()->request->getParam('description'));
        $this->redirect($this->createUrl('history',array('id'=>Yii::app()->request->getParam('userId'))));
    }

    public function actionSub(){
        Balance::pay(Yii::app()->request->getParam('userId'),Yii::app()->request->getParam('cost'),'sub',Yii::app()->request->getParam('description'));
        $this->redirect($this->createUrl('history',array('id'=>Yii::app()->request->getParam('userId'))));
    }

    public function actionRetention(){
        Balance::pay(Yii::app()->request->getParam('userId'),Yii::app()->request->getParam('cost'),'retention',Yii::app()->request->getParam('description'));
        $this->redirect($this->createUrl('history',array('id'=>Yii::app()->request->getParam('userId'))));
    }

    public function actionDelete($id){
        if(!$this->user->can('admin-user')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        if($user = User::model()->findByPk($id)){
            foreach($user->projects as $project){
                $project->delete();
            }
            $user->is_active = 0;
            $user->save(false);
        }
        $this->redirect(array('adminUser/index'));
    }
}

?>
