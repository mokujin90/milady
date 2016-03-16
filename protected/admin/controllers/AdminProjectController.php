<?php

class AdminProjectController extends AdminBaseController
{

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'project';
        $this->pageCaption = 'Project';
        $this->activeMenu = array('project');
        if(!$this->user->can('project')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Project('search');
        $model->unsetAttributes();
        if (isset($_GET['Project'])){
            $model->attributes = $_GET['Project'];
        }
        $this->render('index', array('model' => $model));
    }
    public function actionModeration()
    {
        $this->updatePageSize();
        $model = new Project('search');
        $model->unsetAttributes();
        if (isset($_GET['Project'])){
            $model->attributes = $_GET['Project'];
        }
        $this->render('moderation', array('model' => $model));
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
            if (!$model) {
                throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
            }
            $relation = Project::$params[$model->type]['relation'];
            $contentModel = Project::$params[$model->type]['model'];
        }

        if (Yii::app()->request->isPostRequest && isset($_POST['Project'])) {
            if($model->isNewRecord){
                $model->type = $type;
            }
            $model->status = 'approved';
            $isValidate = CActiveForm::validate(array($model, $model->$relation));
            /*if($model->type==Project::T_INVEST){
                $model->{Project::$params[$type]['relation']}->finance = Crud::gridRequest2Serialize('Finance');
                $model->{Project::$params[$type]['relation']}->no_finRevenue = Crud::gridRequest2Serialize('finRevenue');
                $model->{Project::$params[$type]['relation']}->no_finCleanRevenue = Crud::gridRequest2Serialize('finCleanRevenue');

            }*/
            UserController::beforeSaveTable($model);

            if ($isValidate == '[]') {
                if ($model->save()) {
                    $model->$relation->project_id = $model->id;
                    if ($model->$relation->save()) {
                        UserController::saveTable($model);
                        if(!isset($_POST['update'])){
                            $this->redirect(array('adminProject/index'));
                        } else {
                            $this->redirect(array('adminProject/edit', 'id' => $model->id));
                        }
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
