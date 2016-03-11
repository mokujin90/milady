<?php

class AnalyticsController extends BaseController
{

    public function actionIndex($tag = null, $region = null)
    {
        $this->breadcrumbs = array('Аналитика');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active' => 1));
        $criteria->order='create_date DESC, id DESC';
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
        $excluded = array(
            'news' => array(0),
            'analytics' => array($id),
            'event'=>array(0)
        );

        if (!$model = Analytics::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array(Yii::t('main','Новости. Событи. Аналитка') => $this->createUrl('news/index'), $model->name);

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active'=>1));
        $criteria->order = 'create_date DESC';
        $criteria->limit = 1;
        $criteria->addNotInCondition('id',$excluded['analytics']);
        $lastAnalytic = Analytics::model()->find($criteria);
        if($lastAnalytic){
            $excluded['analytics'][] = $lastAnalytic->id;
        }

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active'=>1));
        $criteria->order = 'create_date DESC';
        $criteria->limit = 4;
        $criteria->addNotInCondition('id',$excluded['news']);
        if(empty($model->region_id)){
            $criteria->addCondition('region_id is NULL');
        }
        else{
            $criteria->addColumnCondition(array('region_id'=>$model->region_id));
        }
        $similarNews = News::model()->findAll($criteria);


        $this->render('/news/detail', array('model' => $model,'lastAnalytic'=>$lastAnalytic,'similarNews'=>$similarNews));
    }
}