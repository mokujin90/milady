<?php
class AdminTenderController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'tender';
        $this->pageCaption = 'Tender';
        $this->activeMenu = array('content', 'tender');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Tender('search');
        $model->unsetAttributes();
        if (isset($_GET['Tender']))
            $model->attributes = $_GET['Tender'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Tender() : Tender::model()->findByPk($id);
        if(!empty($model->create_date)){
            $model->create_date = Candy::formatDate($model->create_date,Candy::DATE);
        }
        if (Yii::app()->request->isPostRequest && isset($_POST['Tender'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            $model->file_id = empty($_POST['file_id']) ? null : $_POST['file_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminTender/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Tender::model()->deleteByPk($id);
        $this->redirect(array('adminTender/index'));
    }
}

?>
