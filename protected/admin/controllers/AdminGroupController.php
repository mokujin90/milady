<?php
class AdminGroupController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'group';
        $this->pageCaption = 'Группы';
        $this->activeMenu = array('group');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Group('search');
        $model->unsetAttributes();
        if (isset($_GET['Group']))
            $model->attributes = $_GET['Group'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Group() : Group::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['Group'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminGroup/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Group::model()->deleteByPk($id);
        $this->redirect(array('adminGroup/index'));
    }
}
?>
