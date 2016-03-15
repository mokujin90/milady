<?php
class AdminAnalyticsController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'analytics';
        $this->pageCaption = 'Analytics';
        $this->activeMenu = array('content', 'analytics');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Analytics('search');
        $model->unsetAttributes();
        if (isset($_GET['Analytics']))
            $model->attributes = $_GET['Analytics'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Analytics() : Analytics::model()->findByPk($id);
        if(!empty($model->create_date)){
            $model->create_date = Candy::formatDate($model->create_date,Candy::DATE);
        }
        if (Yii::app()->request->isPostRequest && isset($_POST['Analytics'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            $model->file_id = empty($_POST['document_id']) ? null : $_POST['document_id'];
            CActiveForm::validate($model);
            if($model->save()){
                $this->checkFiles($model);
                if (!isset($_POST['update'])) {
                    $this->redirect(array('adminAnalytics/index'));
                }
            }

        }
        $this->render('_edit', array('model' => $model));
    }

    private function checkFiles(&$model)
    {

        $postFiles = isset($_POST['file_id']) ? $_POST['file_id'] : array();

        #получим все прешедшие id
        $projectFiles = Analytics2Media::model()->findAllByAttributes(array('analytics_id' => $model->id), array('index' => 'media_id'));
        $newIds = array_keys($postFiles);
        $oldIds = array_keys($projectFiles);
        $createItem = array_diff($newIds, $oldIds);
        $deleteItem = array_diff($oldIds, $newIds);
        foreach ($createItem as $item) {
            $file = new Analytics2Media();
            $file->analytics_id = $model->id;
            $file->media_id = $_POST['file_id'][$item]['id'];
            $file->normal_name =  $_POST['file_id'][$item]['old_name'];
            $file->save();
        }
        Analytics2Media::model()->deleteAllByAttributes(array('media_id' => $deleteItem, 'analytics_id' => $model->id));
    }

    public function actionDelete($id){
        Analytics::model()->deleteByPk($id);
        $this->redirect(array('adminAnalytics/index'));
    }
}

?>
