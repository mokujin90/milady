<?php
class AdminFAQController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'faq';
        $this->pageCaption = 'FAQ';
        $this->activeMenu = array('faq');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new FAQ('search');
        $model->unsetAttributes();
        if (isset($_GET['FAQ']))
            $model->attributes = $_GET['FAQ'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new FAQ() : FAQ::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['FAQ'])) {
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminFAQ/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        FAQ::model()->deleteByPk($id);
        $this->redirect(array('adminFAQ/index'));
    }
}
?>
