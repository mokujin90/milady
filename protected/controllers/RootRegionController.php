<?php

class RootRegionController extends BaseController
{
    public function actionIndex()
    {
        $model = new Region('search');
        $model->unsetAttributes();
        if (isset($_GET['Region']))
            $model->attributes = $_GET['Region'];

        $this->render('regionList', array('model' => $model));
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
            if ($model->save()) {

                $model->content->logo_id = empty($_POST['logo_id']) ? null : $_POST['logo_id'];
                $model->content->mayor_logo = empty($_POST['mayor_logo']) ? null : $_POST['mayor_logo'];
                $model->content->region_id = $model->id;
                $model->content->save();
                $this->redirect(array('rootRegion/index'));
            }
        }
        $this->render('regionEdit', array('model' => $model));
    }

   public function actionDelete($id){
       Region::model()->deleteByPk($id);
       $this->redirect(array('rootRegion/index'));
   }

}