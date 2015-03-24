<?php

class AdminCityController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'city';
        $this->pageCaption = 'Города';
        return true;
    }

    public function actionIndex()
    {
        $model = new RegionCity('search');
        $model->unsetAttributes();
        if (isset($_GET['RegionCity']))
            $model->attributes = $_GET['RegionCity'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null,$regionId=null)
    {
        $model = is_null($id) ? new RegionCity() : RegionCity::model()->findByPk($id);
        if(!is_null($regionId)){
            $model->region_id = $regionId;
        }
        if (Yii::app()->request->isPostRequest && isset($_POST['RegionCity'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            $isValid = CActiveForm::validate($model);
            if ($model->save()) {
                $this->redirect(array('adminCity/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($id)
    {
        RegionCity::model()->deleteByPk($id);
        $this->redirect(array('adminCity/index'));
    }

    public function actionGetNewCity($regionId)
    {
        $model = new RegionCity();
        $model->region_id = $regionId;
        $randomId = rand(0,99999999999);
        $this->renderPartial('partial/_editCity', array('model' => $model, 'form' => new CActiveForm(),'id'=>$randomId,'new'=>true));
    }

    public function actionDeleteCity($id){
        RegionCity::model()->deleteByPk($id);
        $this->redirect(array('adminRegion/index'));
    }

    public function actionShowCities($regionId){
        $model = Region::model()->findByPk($regionId);
        $this->renderPartial('partial/_city',array(
            'form'=>new CActiveForm(),
            'model'=>$model,
        ));
    }
}

?>
