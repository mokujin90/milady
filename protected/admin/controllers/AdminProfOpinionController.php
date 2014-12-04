<?php
class AdminProfOpinionController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'prof_opinion';
        $this->pageCaption = 'ProfOpinion';
        return true;
    }

    public function actionIndex()
    {
        $model = new ProfOpinion('search');
        $model->unsetAttributes();
        if (isset($_GET['ProfOpinion']))
            $model->attributes = $_GET['ProfOpinion'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new ProfOpinion() : ProfOpinion::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['ProfOpinion'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save()) {
                $this->redirect(array('adminProfOpinion/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        News::model()->deleteByPk($id);
        $this->redirect(array('adminProfOpinion/index'));
    }
}

?>
