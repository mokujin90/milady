<?php
class AdminBannerController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'banner';
        $this->pageCaption = 'Баннеры';
        $this->activeMenu = array('adv', 'banner');
        if(!$this->user->can('adv')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Banner('search');
        $model->unsetAttributes();
        if (isset($_GET['Banner']))
            $model->attributes = $_GET['Banner'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = Banner::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['Banner'])) {
            $model->status = $_POST['Banner']['status'];
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminBanner/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Banner::model()->deleteByPk($id);
        $this->redirect(array('adminBanner/index'));
    }
}

?>
