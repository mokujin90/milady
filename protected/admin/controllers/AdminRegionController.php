<?php

class AdminRegionController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'region';
        $this->pageCaption = 'Region';
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Region('search');
        $model->unsetAttributes();
        if (isset($_GET['Region']))
            $model->attributes = $_GET['Region'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Region() : Region::model()->with('content')->findByPk($id);
        if (count($model->content) == 0) {
            $model->content = new RegionContent();
        }
        if (Yii::app()->request->isPostRequest && isset($_POST['Region'])) {
            if ($model->isNewRecord) {
                $model->district_id = 1;
            }
            $isValid = CActiveForm::validate(array($model, $model->content));

            $model->content->logo_id = empty($_POST['logo_id']) ? null : $_POST['logo_id'];
            $model->content->mayor_logo = empty($_POST['mayor_logo']) ? null : $_POST['mayor_logo'];
            $model->content->infographic_media_id = empty($_POST['infographic_media_id']) ? null : $_POST['infographic_media_id'];
            $model->content->region_id = $model->id;

            $model->content->hospital_count_chart = RegionContent::serializeChart('hospitalChart');
            $model->content->hospital2_count_chart = RegionContent::serializeChart('hospital2Chart');
            $model->content->school_count_chart = RegionContent::serializeChart('schoolChart');
            $model->content->university_count_chart = RegionContent::serializeChart('uniChart');
            $model->content->sport_count_chart = RegionContent::serializeChart('sportChart');
            $model->content->cult_count_chart = RegionContent::serializeChart('cultChart');
            $model->content->invest_capital_chart = RegionContent::serializeChart('capitalChart');

            RegionPlace::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $this->saveSubTable($model->id, "port", 'RegionPlace', 'RegionPort');
            $this->saveSubTable($model->id, "airport", 'RegionPlace', 'RegionAirport');
            $this->saveSubTable($model->id, "station", 'RegionPlace', 'RegionStation');

            RegionCompany::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $this->saveSubTable($model->id, "development_institute", 'RegionCompany', 'RegionDevIns');
            $this->saveSubTable($model->id, "planing_infrastruct", 'RegionCompany', 'RegionPlanInfra');
            $this->saveSubTable($model->id, "great_school", 'RegionCompany', 'RegionSchool');
            $this->saveSubTable($model->id, "bank", 'RegionCompany', 'RegionBank');
            $this->saveSubTable($model->id, "business_bank", 'RegionCompany', 'RegionBusinessBank');
            $this->saveSubTable($model->id, "organization", 'RegionCompany', 'RegionOrg');
            $this->saveSubTable($model->id, "company", 'RegionCompany', 'Company');

            RegionUniversity::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $modelsUni = Crud::gridRequest2Models("RegionUniversity");
            foreach ($modelsUni as $modelUni) {
                $modelUni->region_id = $model->id;
                $modelUni->save();
            }

            if ($model->save()) {
                if($model->content->save() && !isset($_POST['update'])){
                    $this->redirect(array('adminRegion/index'));
                }
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    private function saveSubTable($regionId, $type, $modelName, $requestName)
    {
        $models = Crud::gridRequest2Models($modelName, $requestName);
        foreach ($models as $model) {
            $model->region_id = $regionId;
            $model->type = $type;
            $model->save();
        }
    }

    public function actionDelete($id)
    {
        Region::model()->deleteByPk($id);
        $this->redirect(array('adminRegion/index'));
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
