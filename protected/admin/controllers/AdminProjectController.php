<?php

class AdminProjectController extends AdminBaseController
{

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'project';
        $this->pageCaption = 'Project';
        return true;
    }

    public function actionIndex()
    {
        $model = new Project('search');
        $model->unsetAttributes();
        if (isset($_GET['Project']))
            $model->attributes = $_GET['Project'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($type=1,$id = null)
    {


        if(is_null($id)){
            $contentModel = Project::$params[$type]['model'];
            $relation = Project::$params[$type]['relation'];
            $model = new Project();
            $model->type = $type;
            $model->$relation = new $contentModel();
        }
        else{
            $model = Project::model()->findByPk($id);
            $relation = Project::$params[$model->type]['relation'];
            $contentModel = Project::$params[$model->type]['model'];
        }

        if (Yii::app()->request->isPostRequest && isset($_POST['Project'])) {
            if($model->isNewRecord){
                $model->type = $type;
            }
            $model->status = 'approved';
            $isValidate = CActiveForm::validate(array($model, $model->$relation));
            $model->logo_id = Yii::app()->request->getParam('logo_id')=="" ? null : Yii::app()->request->getParam('logo_id');
            if ($isValidate == '[]') {
                if ($model->save()) {
                    $model->$relation->project_id = $model->id;
                    if ($model->$relation->save()) {
                        $this->redirect(array('adminProject/index'));
                    }
                }
            }
        }
        $this->render('edit', array('model' => $model,'relation'=>$relation,'contentModel'=>$contentModel));
    }

    public function actionDelete($id)
    {
        Project::model()->deleteByPk($id);
        $this->redirect(array('adminProject/index'));
    }
}

?>
