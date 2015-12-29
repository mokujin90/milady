<?php
class AdminReferenceTransportController extends AdminBaseController
{

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->pageCaption = 'Reference';
        $this->activeMenu = array('reference', 'transport');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new ReferenceTransport('search');
        $model->unsetAttributes();
        if (isset($_GET['ReferenceTransport']))
            $model->attributes = $_GET['ReferenceTransport'];
        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new ReferenceTransport() : ReferenceTransport::model()->findByPk($id);
        if (Yii::app()->request->isPostRequest && isset($_POST['ReferenceTransport'])) {
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminReferenceTransport/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        ReferenceTransport::model()->deleteByPk($id);
        $this->redirect(array('adminReferenceTransport/index'));
    }
}

?>
