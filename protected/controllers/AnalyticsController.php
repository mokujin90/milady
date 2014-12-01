<?php

class AnalyticsController extends BaseController
{

    public function actionIndex($tag = null, $region = null)
    {
        $this->breadcrumbs = array('Аналитика');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active' => 1));
        $criteria->order='create_date DESC';
        if (!empty($tag)) {
            $criteria->addSearchCondition('tags', $tag);
            $this->breadcrumbs = array('Аналитика' => $this->createUrl('analytics/index'), "Аналитика с тегом: $tag");
        }
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('category', $_GET['hide']);
        }
        $pages = $this->applyLimit($criteria,'Analytics');
        $models = Analytics::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'pages'=>$pages));
    }

    public function actionDetail($id)
    {

        if(!$model = Analytics::model()->findByPk($id)){
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array('Аналитика' => $this->createUrl('analytics/index'), $model->name);

        $this->render('detail', array('model' => $model));
    }
}