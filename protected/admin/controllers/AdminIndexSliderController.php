<?php
class AdminIndexSliderController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'indexslider';
        $this->pageCaption = 'Слайдер на главной';
        $this->activeMenu = array('content', 'indexslider');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new IndexSlider('search');
        $model->unsetAttributes();
        if (isset($_GET['IndexSlider']))
            $model->attributes = $_GET['IndexSlider'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new IndexSlider() : IndexSlider::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['IndexSlider'])) {
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminIndexSlider/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        IndexSlider::model()->deleteByPk($id);
        $this->redirect(array('adminIndexSlider/index'));
    }
}

?>
