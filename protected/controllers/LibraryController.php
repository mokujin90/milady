<?php

class LibraryController extends BaseController
{

    public function actionIndex()
    {
        throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));

        $this->layout = 'main_old';
        $this->breadcrumbs = array('Библиотека');
        $criteria = new CDbCriteria();
        $criteria->order='create_date DESC';
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('division_id', $_GET['hide']);
        }
        $pages = $this->applyLimit($criteria,'Library');
        $models = Library::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'pages'=>$pages));
    }
}