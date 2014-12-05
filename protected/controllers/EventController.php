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
        $this->breadcrumbs = array('Мероприятия' => $this->createUrl('event/index'), $model->name);

        $this->render('detail', array('model' => $model));
    }

    public function actionGetItem($date){
        $model = Event::model()->findByAttributes(array('create_date' => $date, 'is_active'=>1), array('order' => 'id DESC'));
        $this->renderPartial('_item', array('model' => $model), false, true);
    }
}