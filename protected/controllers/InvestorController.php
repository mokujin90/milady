<?php

class InvestorController extends BaseController
{
    public function actionIndex(){
        $models = User::model()->findAllByAttributes(array('type'=>'investor'));
        $this->render('index',array('models' => $models));
    }
    public function actionDetail($id=null)
    {
        $this->render('index');
    }
}