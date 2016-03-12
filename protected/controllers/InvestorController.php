<?php

class InvestorController extends BaseController
{
    public function actionIndex(){
        $this->breadcrumbs = array('Инвесторы');
        $criteria = new CDbCriteria();
        $criteria->addCondition('type = "investor" AND is_active = 1');
        $filter = new InvestorFilter();

        if(isset($_GET['InvestorFilter'])){
            $filter->apply($criteria);
        }

        $pages = $this->applyLimit($criteria,'User',5);
        $models = User::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'filter'=>$filter, 'pages' => $pages));
    }

    public function actionView($id){
        $this->breadcrumbs = array('Инвесторы');
        $model = User::model()->findByAttributes(array('id' => $id, 'type' => 'investor'));
        if (!$model) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->render('view',array('model' => $model));
    }

}