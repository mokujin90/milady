<?php

class NewsController extends BaseController
{

    public function actionIndex($tag = null, $region = null)
    {
        $this->breadcrumbs = array('Новости');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active' => 1));
        $criteria->order='create_date DESC';
        if (!empty($tag)) {
            $criteria->addSearchCondition('tags', $tag);
            $this->breadcrumbs = array('Новости' => $this->createUrl('news/index'), "Новости с тегом: $tag");
        } elseif (!empty($region) && $regionModel = Region::model()->findByPk($region)) {
            $criteria->addSearchCondition('region_id', $region);
            $this->breadcrumbs = array('Новости' => $this->createUrl('news/index'), "Регион: {$regionModel->name}");
        }
        $pages = $this->applyLimit($criteria,'News');
        $models = News::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'pages'=>$pages));
    }

    public function actionDetail($id)
    {

        if(!$model = News::model()->findByPk($id)){
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array('Новости' => $this->createUrl('news/index'), $model->name);

        $this->render('detail', array('model' => $model));
    }
}