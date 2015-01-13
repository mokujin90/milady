<?php
class AdminNewsController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'news';
        $this->pageCaption = 'News';
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new News('search');
        $model->unsetAttributes();
        if (isset($_GET['News']))
            $model->attributes = $_GET['News'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new News() : News::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['News'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminNews/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        News::model()->deleteByPk($id);
        $this->redirect(array('adminNews/index'));
    }
}

?>
