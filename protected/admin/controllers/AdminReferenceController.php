<?php
class AdminReferenceController extends AdminBaseController
{
    public $enableModels = array(
        'ReferenceIndustry',
        'ReferenceNatureZone',
        'ReferenceRegionCompanyType',
    );
    public $mediaModels = array(
        'ReferenceIndustry',
        'ReferenceNatureZone'
    );
    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->pageCaption = 'Reference';
        $this->activeMenu = array('reference');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex($ref)
    {
        $this->checkRef($ref);
        $this->updatePageSize();
        $model = new $ref('search');
        $model->unsetAttributes();
        if (isset($_GET[$ref]))
            $model->attributes = $_GET[$ref];
        $this->render('index', array('model' => $model));
    }

    public function actionEdit($ref, $id = null)
    {
        $this->checkRef($ref);
        $model = is_null($id) ? new $ref() : $ref::model()->findByPk($id);
        if (Yii::app()->request->isPostRequest && isset($_POST[$ref])) {
            if(in_array($_GET['ref'], $this->mediaModels)) {
                $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            }
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminReference/index', 'ref' => $ref));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($ref, $id){
        $this->checkRef($ref);
        $ref::model()->deleteByPk($id);
        $this->redirect(array('adminReference/index', 'ref' => $ref));
    }

    private function checkRef($ref)
    {
        $this->activeMenu[] = $ref;
        if(!in_array($ref, $this->enableModels)){
            throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        }
    }
}

?>
