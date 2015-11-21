<?php
class AdminFeedBannerController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'feedbanner';
        $this->pageCaption = 'Объявления';
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new FeedBanner('search');
        $model->unsetAttributes();
        if (isset($_GET['FeedBanner']))
            $model->attributes = $_GET['FeedBanner'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = FeedBanner::model()->findByPk($id);
        if (Yii::app()->request->isPostRequest && isset($_POST['FeedBanner'])) {
            $model->status = $_POST['FeedBanner']['status'];
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminFeedBanner/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        FeedBanner::model()->deleteByPk($id);
        $this->redirect(array('adminFeedBanner/index'));
    }
}

?>
