<?php
class AdminAdminUserController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'news';
        $this->pageCaption = 'News';
        $this->activeMenu = array('admin-user');
        if(!$this->user->can('admin-user')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new AdminUser('search');
        $model->unsetAttributes();
        if (isset($_GET['AdminUser']))
            $model->attributes = $_GET['AdminUser'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new AdminUser() : AdminUser::model()->findByPk($id);
        $model->adminRightsField = array();


        if (Yii::app()->request->isPostRequest && isset($_POST['AdminUser'])) {
            $model->adminRightsField = isset($_POST['Admin2Right']) ? $_POST['Admin2Right'] : array();
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminAdminUser/index'));
            }
        } else {
            foreach($model->admin2Rights as $right){
                $model->adminRightsField[$right->right] = 1;
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        AdminUser::model()->deleteByPk($id);
        $this->redirect(array('adminAdminUser/index'));
    }
}

?>
