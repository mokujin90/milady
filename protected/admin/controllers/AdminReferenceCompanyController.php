<?php
class AdminReferenceCompanyController extends AdminBaseController
{

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->pageCaption = 'Reference';
        $this->activeMenu = array('reference', 'ReferenceRegionCompany');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new ReferenceRegionCompany('search');
        $model->unsetAttributes();
        if (isset($_GET['ReferenceRegionCompany']))
            $model->attributes = $_GET['ReferenceRegionCompany'];
        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new ReferenceRegionCompany() : ReferenceRegionCompany::model()->findByPk($id);
        if (Yii::app()->request->isPostRequest && isset($_POST['ReferenceRegionCompany'])) {
           $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminReferenceCompany/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        ReferenceRegionCompany::model()->deleteByPk($id);
        $this->redirect(array('adminReferenceCompany/index'));
    }
}

?>
