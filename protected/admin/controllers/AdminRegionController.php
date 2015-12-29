<?php

class AdminRegionController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'region';
        $this->pageCaption = 'Region';
        $this->activeMenu = array('region');
        if(!$this->user->can('region')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
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
        $saveStatus = false;
        if (Yii::app()->request->isPostRequest && isset($_POST['Region'])) {
            $model->content->industry_format_field = array();
            $model->content->nature_zone_field = array();

            if ($model->isNewRecord) {
                $model->district_id = 1;
            }
            $isValid = CActiveForm::validate(array($model, $model->content));

            $model->content->invest_politics_text = isset($_POST['RegionContent']['invest_politics_text']) ? $_POST['RegionContent']['invest_politics_text'] : '';

            $model->content->logo_id = empty($_POST['logo_id']) ? null : $_POST['logo_id'];
            $model->content->mayor_logo = empty($_POST['mayor_logo']) ? null : $_POST['mayor_logo'];
            //s$model->content->infographic_media_id = empty($_POST['infographic_media_id']) ? null : $_POST['infographic_media_id'];
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

            Region2Transport::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $this->saveTransportTable($model->id, "port", 'RegionPort');
            $this->saveTransportTable($model->id, "air", 'RegionAirport');
            $this->saveTransportTable($model->id, "railway", 'RegionStation');

            Region2Company::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $this->saveCompanyTable($model->id, "development_institute", 'RegionDevIns');
            $this->saveCompanyTable($model->id, "planing_infrastruct", 'RegionPlanInfra');
            $this->saveCompanyTable($model->id, "great_school", 'RegionSchool');
            $this->saveCompanyTable($model->id, "bank", 'RegionBank');
            $this->saveCompanyTable($model->id, "business_bank", 'RegionBusinessBank');
            $this->saveCompanyTable($model->id, "organization", 'RegionOrg');
            $this->saveCompanyTable($model->id, "company", 'RegionCompany');

            /*RegionCompany::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $this->saveSubTable($model->id, "development_institute", 'RegionCompany', 'RegionDevIns');
            $this->saveSubTable($model->id, "planing_infrastruct", 'RegionCompany', 'RegionPlanInfra');
            $this->saveSubTable($model->id, "great_school", 'RegionCompany', 'RegionSchool');
            $this->saveSubTable($model->id, "bank", 'RegionCompany', 'RegionBank');
            $this->saveSubTable($model->id, "business_bank", 'RegionCompany', 'RegionBusinessBank');
            $this->saveSubTable($model->id, "organization", 'RegionCompany', 'RegionOrg');
            $this->saveSubTable($model->id, "company", 'RegionCompany', 'RegionCompany');*/

            RegionUniversity::model()->deleteAllByAttributes(array('region_id' => $model->id));
            $modelsUni = Crud::gridRequest2Models("RegionUniversity");
            foreach ($modelsUni as $modelUni) {
                $modelUni->region_id = $model->id;
                $modelUni->save();
            }

            RegionProof::model()->deleteAllByAttributes(array('region_id' => $model->id));
            if(isset($_POST['RegionProof'])){
                foreach($_POST['RegionProof'] as $key => $title){
                    if(empty($title) && empty($_POST["{$key}_media_id"])){
                        continue;
                    }
                    $proof = new RegionProof();
                    $proof->attr = $key;
                    $proof->region_id = $model->id;
                    $proof->title = $title;
                    $proof->media_id = empty($_POST["{$key}_media_id"]) ? null : $_POST["{$key}_media_id"];
                    $proof->save();
                }
            }

            Region2File::model()->deleteAllByAttributes(array('region_id' => $model->id));
            if(isset($_POST['file_id'])) {
                foreach ($_POST['file_id'] as $item) {
                    $file = new Region2File();
                    $file->region_id = $model->id;
                    $file->media_id = $item['id'];
                    $file->name = $item['old_name'];
                    $file->title = isset($item['title']) ? $item['title'] : null;
                    $file->save();
                }
            }

            if ($model->save()) {
                if (is_null($id)) {
                    $model->content->region_id = $model->id;
                }
                if($model->content->save() && !isset($_POST['update'])){
                    $saveStatus = true;
                    if (!Yii::app()->request->isAjaxRequest) {
                        $this->redirect(array('adminRegion/index'));
                    }
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest) {
            if(!$saveStatus){
                $errorStr = array();
                foreach($model->errors as $name => $error){
                    $errorStr[] = $model->getAttributeLabel($name) . ": " . $error[0];
                }
                foreach($model->content->errors as $name => $error){
                    $errorStr[] = $model->content->getAttributeLabel($name) . ": " . $error[0];
                }
                @ob_clean();
                echo json_encode(array(
                    'result' => $saveStatus,
                    'errors' => implode('<br>' , $errorStr),
                ));
            } else {
                @ob_clean();
                echo json_encode(array('result' => $saveStatus));
            }
        } else {
            $this->render('_edit', array('model' => $model));
        }
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
            $file->title = isset($_POST['file_id'][$item]['title']) ? $_POST['file_id'][$item]['title'] : null;
            $file->save();
        }
        Region2File::model()->deleteAllByAttributes(array('media_id' => $deleteItem, 'region_id' => $model->id));
    }

    private function saveCompanyTable($regionId, $type, $requestName)
    {
        if(isset($_REQUEST[$requestName])){
            foreach($_REQUEST[$requestName] as $id){
                if(empty($id)) continue;
                $model = new Region2Company();
                $model->region_id = $regionId;
                $model->company_id = $id;
                $model->type = $type;
                $model->save();
            }
        }
    }

    private function saveTransportTable($regionId, $type, $requestName)
    {
        if(isset($_REQUEST[$requestName])){
            foreach($_REQUEST[$requestName] as $id){
                if(empty($id)) continue;
                $model = new Region2Transport();
                $model->region_id = $regionId;
                $model->transport_id = $id;
                $model->type = $type;
                $model->save();
            }
        }
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
        if(!$this->user->can('admin-user')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа, удалять регионы может только СуперАдмин.'));

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

    public function actionchangeCityVisibility(){
        $result = array('success' => false);
        if(isset($_REQUEST['id']) && isset($_REQUEST['value'])){
            if($model = RegionCity::model()->findByPk($_REQUEST['id'])){
                $model->is_hidden = (int)$_REQUEST['value'] ? 0 : 1;
                if($model->save()){
                    $result = array('success' => true);
                }
            }
        }
        echo json_encode($result);
    }

    public function actionGetCompaniesJSON(){
        $result = array('success' => false);
        if(isset($_REQUEST['type_id'])){
            $data = array();
            foreach(ReferenceRegionCompany::model()->findAllByAttributes(array('type_id' => $_REQUEST['type_id']), array('order' => 'name')) as $item){
                $data[] = array(
                    'id' => $item->id,
                    'name' => $item->name
                );
            }
            $result = array(
                    'success' => true,
                    'options' => $data
                );
        }
        echo json_encode($result);
    }
}

?>
