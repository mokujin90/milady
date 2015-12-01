<?php
class AdminSliderController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'slider';
        $this->pageCaption = 'Слайдер';
        $this->activeMenu = array('adv', 'slider');
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Slider('search');
        $model->unsetAttributes();
        if (isset($_GET['Slider']))
            $model->attributes = $_GET['Slider'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Slider() : Slider::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['Slider'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminSlider/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id){
        Slider::model()->deleteByPk($id);
        $this->redirect(array('adminSlider/index'));
    }
}

?>
