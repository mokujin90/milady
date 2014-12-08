<?php

class LawController extends BaseController
{

    public function actionIndex()
    {
        $this->breadcrumbs = array('Законодательство');
        $criteria = new CDbCriteria();
        $criteria->order='create_date DESC';
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('division_id', $_GET['hide']);
        }
        $pages = $this->applyLimit($criteria,'Law');
        $models = Law::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'pages'=>$pages));
    }

}