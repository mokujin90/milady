<?php

class AdminCityController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'city';
        $this->pageCaption = 'Города';
        $this->activeMenu = array('region', 'city');
        if(!$this->user->can('region')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
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

    public function actionParseCity(){
        if(!$this->user->can('admin-user')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));

        if (isset($_POST)) {
            if($_FILES['csv']){
                $handle = fopen($_FILES['csv']['tmp_name'], "r");
                while (($data = fgets($handle, 1000)) !== FALSE) {
                    $data = explode(',', iconv( 'CP1251', 'UTF-8', $data));
                    if(substr($data[2], 2, 1) == 7 AND strlen($data[2]) == 15){ //code has 7 (city index) && city length (15 chars)
                        if(strpos($data[4], 'г.') !== false){ //есть город в навзании
                            if(!$model = RegionCity::model()->findByAttributes(array('parse_id' => $data[2]))){ //ищем по ID из CSV
                                $regionCode =  substr($data[2], 0, 2);
                                if($region = Region::model()->findByAttributes(array('parse_id' => $regionCode))){ //ищем регион в который парсить
                                    $data[4] = str_replace('г. ', '', $data[4]); //удаляем г. из имени
                                    if(!$model = RegionCity::model()->findByAttributes(array('name' => $data[4]))){ //пытаемся найти город по имени(т.к. PARSE_ID не указан)
                                        $model = new RegionCity();
                                        $model->region_id = $region->id;
                                        $model->name = $data[4];
                                        $model->count_people = $data[5];
                                        $model->parse_id = $data[2];
                                        $model->lat = 55.7425739894847; //moscow
                                        $model->lon = 37.606201171875;
                                    } else { //нашли город по имени
                                        $model->parse_id = $data[2];
                                        $model->count_people = $data[5];
                                    }
                                }
                            } else {//нашли город по PARSE_ID
                                $model->count_people = $data[5];
                            }
                            if($model){
                                $model->save();
                            }
                        }
                    }
                }
                fclose($handle);
            }

        }
        $this->redirect($this->createUrl('adminCity/index'));
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
