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

            $model->content->invest_politics_text = isset($_POST['RegionContent']['invest_politics_text']) ? $_POST['RegionContent']['invest_politics_text'] : '';

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
            $model->content->inno1_chart = RegionContent::serializeChart('inno1Chart');
            $model->content->inno2_chart = RegionContent::serializeChart('inno2Chart');
            $model->content->inno3_chart = RegionContent::serializeChart('inno3Chart');

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
            $this->saveSubTable($model->id, "company", 'RegionCompany', 'RegionCompany');

            RegionUniversity::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $modelsUni = Crud::gridRequest2Models("RegionUniversity");
            foreach ($modelsUni as $modelUni) {
                $modelUni->region_id = $model->id;
                $modelUni->save();
            }

            if ($model->save()) {
                if($model->content->save() && !isset($_POST['update'])){
                    $this->checkFiles($model);
                    $this->redirect(array('adminRegion/index'));
                }
            }
        }
        $this->render('_edit', array('model' => $model));
    }
    /**
     * Сохраним файлы от переданной модели
     * @param $model Region
     */
    private function checkFiles(&$model)
    {
        $postFiles = isset($_POST['file_id']) ? $_POST['file_id'] : array();
        #получим все прешедшие id
        $regionFiles = Region2File::model()->findAllByAttributes(array('region_id' => $model->id), array('index' => 'media_id'));
        $newIds = array_keys($postFiles);
        $oldIds = array_keys($regionFiles);
        $createItem = array_diff($newIds, $oldIds);
        $deleteItem = array_diff($oldIds, $newIds);
        foreach ($createItem as $item) {
            $file = new Region2File();
            $file->region_id = $model->id;
            $file->media_id = $_POST['file_id'][$item]['id'];
            $file->name = $_POST['file_id'][$item]['old_name'];
            $file->save();
        }
        Region2File::model()->deleteAllByAttributes(array('media_id' => $deleteItem, 'region_id' => $model->id));
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
