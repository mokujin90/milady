<?php

class LawController extends BaseController
{

    public function actionIndex($region = null)
    {
        throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));

        $this->layout = 'main_old';

        $this->breadcrumbs = array('Законодательство');
        $criteria = new CDbCriteria();
        $criteria->order='create_date DESC';
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('division_id', $_GET['hide']);
        }
        if (!empty($region) && $regionModel = Region::model()->findByPk($region)) {
            $criteria->addSearchCondition('region_id', $region);
            $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$regionModel->name}" =>$this->createUrl('region/index', array('id' => $regionModel->id)), 'Региональное законодательство');
        } else {
            $criteria->addCondition('region_id IS NULL');
        }
        $pages = $this->applyLimit($criteria,'Law');
        $models = Law::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'pages'=>$pages));
    }

}