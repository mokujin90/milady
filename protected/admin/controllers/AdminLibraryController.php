<?php
class AdminLibraryController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'library';
        $this->pageCaption = 'Библиотека';
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Library('search');
        $model->unsetAttributes();
        if (isset($_GET[CHtml::modelName($model)]))
            $model->attributes = $_GET[CHtml::modelName($model)];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Library() : Library::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST[CHtml::modelName($model)])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            $model->normal_name = empty($_POST['normal_name']) ? null : $_POST['normal_name'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminLibrary/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Library::model()->deleteByPk($id);
        $this->redirect(array('adminLibrary/index'));
    }
}