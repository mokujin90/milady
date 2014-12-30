<?php
class AdminBannerController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'banner';
        $this->pageCaption = 'Баннеры';
        return true;
    }

    public function actionIndex()
    {
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
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save()) {
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
