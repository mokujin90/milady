<?php
class AdminStaticBannerController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'banner';
        $this->pageCaption = 'Статические баннеры';
        return true;
    }

    public function actionIndex()
    {
        $model = new StaticBanner('search');
        $model->unsetAttributes();
        if (isset($_GET['StaticBanner']))
            $model->attributes = $_GET['StaticBanner'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = StaticBanner::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['StaticBanner'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save()) {
                $this->redirect(array('adminStaticBanner/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

}

?>
