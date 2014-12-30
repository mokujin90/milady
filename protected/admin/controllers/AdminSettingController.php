<?php
class AdminSettingController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'setting';
        $this->pageCaption = 'Настройки';
        return true;
    }

    public function actionIndex()
    {
        $error = array();
        $models = Setting::load();
        if(Yii::app()->request->isPostRequest && isset($_REQUEST['Setting'])){
            $error = Setting::saveSetting($_REQUEST['Setting']);
            $models = Setting::load();
        }
        $this->render('index',array('models'=>$models,'error'=>$error));
    }
}

?>
