<?php

class InvestorController extends BaseController
{
    public function actionIndex(){
        $this->breadcrumbs = array('Инвесторы');
        $criteria = new CDbCriteria();
        $criteria->addCondition('type = "investor"');
        $filter = new InvestorFilter();

        if(isset($_GET['InvestorFilter'])){
            $filter->apply($criteria);
        }

        $this->applyLimit($criteria,'User');
        $models = User::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'filter'=>$filter));
    }

}