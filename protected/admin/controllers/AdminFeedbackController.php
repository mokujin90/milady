<?php
class AdminFeedbackController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'Feedback';
        $this->pageCaption = 'Обратная связь';
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Feedback('search');
        $model->unsetAttributes();
        if (isset($_GET[CHtml::modelName($model)]))
            $model->attributes = $_GET[CHtml::modelName($model)];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = Feedback::model()->findByPk($id);
        if($model->is_read==0){
            $model->is_read = 1;
            $model->save();
        }
        if (Yii::app()->request->isPostRequest && isset($_POST[CHtml::modelName($model)])) {
            CActiveForm::validate($model);
            if ($model->save()) {
                $this->redirect(array('adminFeedback/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Feedback::model()->deleteByPk($id);
        $this->redirect(array('adminFeedback/index'));
    }
}