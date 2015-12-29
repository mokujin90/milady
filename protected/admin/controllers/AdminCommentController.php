<?php
class AdminCommentController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'comment';
        $this->pageCaption = 'Комментарии';
        $this->activeMenu = array('comment');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Comment('search');
        $model->unsetAttributes();
        if (isset($_GET['Comment']))
            $model->attributes = $_GET['Comment'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Comment() : Comment::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['Comment'])) {
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminComment/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Comment::model()->deleteByPk($id);
        $this->redirect(array('adminComment/index'));
    }
}
?>
