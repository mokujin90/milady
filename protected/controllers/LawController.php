<?php

class LawController extends BaseController
{

    public function actionIndex($region = null)
    {
        $this->breadcrumbs = array('Законодательство');
        $criteria = new CDbCriteria();
        $criteria->order='create_date DESC';
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('division_id', $_GET['hide']);
        }
        if (!empty($region) && $regionModel = Region::model()->findByPk($region)) {
            $criteria->addSearchCondition('region_id', $region);
            //$this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$region->region->name}" =>$this->createUrl('region/index'), 'Региональное законодательство');
            $this->breadcrumbs = array('Законодательство' => $this->createUrl('law/index'), "Регион: {$regionModel->name}");
        }
        $pages = $this->applyLimit($criteria,'Law');
        $models = Law::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'pages'=>$pages));
    }

}