<?php

class EventController extends BaseController
{

    public function actionIndex($tag = null, $region = null)
    {
        $this->breadcrumbs = array('Мероприятия');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active' => 1));
        $criteria->order='create_date DESC, id DESC';
        $pages = $this->applyLimit($criteria,'Event');
        $models = Event::model()->findAll($criteria);

        $this->render('index',array('models' => $models,'pages'=>$pages));
    }

    public function actionDetail($id)
    {

        if(!$model = Event::model()->findByPk($id)){
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $slider = array();
        if($model->media){
            $slider[] = $model->media;
        }
        if(count($model->sliders)>0){
            foreach($model->sliders as $slide){
                $slider[] = $slide->media;
            }
        }
        $this->breadcrumbs = array(Yii::t('main','Новости.Аналитика.События') => $this->createUrl('news/index'), $model->name);

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active'=>1));
        $criteria->order = 'create_date DESC';
        $criteria->limit = 4;
        $criteria->addCondition('region_id is NULL');
        $similarNews = News::model()->findAll($criteria);
        $this->render('detail', array('model' => $model,'similarNews'=>$similarNews,'slider'=>$slider));
    }

    public function actionGetItem($date){
        $model = Event::model()->findByAttributes(array('create_date' => $date, 'is_active'=>1), array('order' => 'id DESC'));
        $this->renderPartial('_item', array('model' => $model), false, true);
    }
    public function actionCalendarUpdate($date) {
        Candy::cleanBuffer();
        $this->renderPartial('_widget', array('date' => $date));
    }
}