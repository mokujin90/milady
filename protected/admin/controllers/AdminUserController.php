<?php

class AdminUserController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'user';
        $this->pageCaption = 'Пользователи';
        return true;
    }

    public function actionIndex()
    {
        $model = new User('search');
        $model->unsetAttributes();
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('index', array('model' => $model));
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
}

?>
