<?php
class AdminAnalyticsController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'analytics';
        $this->pageCaption = 'Analytics';
        $this->activeMenu = array('content', 'analytics');
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Analytics('search');
        $model->unsetAttributes();
        if (isset($_GET['Analytics']))
            $model->attributes = $_GET['Analytics'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Analytics() : Analytics::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['Analytics'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            $model->file_id = empty($_POST['file_id']) ? null : $_POST['file_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminAnalytics/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Analytics::model()->deleteByPk($id);
        $this->redirect(array('adminAnalytics/index'));
    }
}

?>
