<?php
class AdminEventController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'event';
        $this->pageCaption = 'Event';
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Event('search');
        $model->unsetAttributes();
        if (isset($_GET['Event']))
            $model->attributes = $_GET['Event'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Event() : Event::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['Event'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);

            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminEvent/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Event::model()->deleteByPk($id);
        $this->redirect(array('adminEvent/index'));
    }
}