<?php
class AdminAnalyticsController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'analytics';
        $this->pageCaption = 'Analytics';
        return true;
    }

    public function actionIndex()
    {
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
            CActiveForm::validate($model);
            if ($model->save()) {
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
