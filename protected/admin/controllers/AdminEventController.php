<?php
class AdminEventController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'event';
        $this->pageCaption = 'Event';
        $this->activeMenu = array('content', 'event');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new Event('search');
        $model->unsetAttributes();
        if (isset($_GET['Event']))
            $model->attributes = $_GET['Event'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Event() : Event::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['Event'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            CActiveForm::validate($model);
            if($model->save()){
                $this->checkFiles($model);
                if (!isset($_POST['update'])) {
                    $this->redirect(array('adminEvent/index'));
                }
            }
        }
        else{
            if(!$model->isNewRecord){
                $date = explode(' ',$model->datetime);
                $model->datetime = $date[0];
                $model->time = $date[1];
            }
        }

        $this->render('_edit', array('model' => $model));
    }

    private function checkFiles(&$model)
    {
        $postFiles = isset($_POST['file_id']) ? $_POST['file_id'] : array();
        #получим все прешедшие id
        $projectFiles = Event2Media::model()->findAllByAttributes(array('event_id' => $model->id), array('index' => 'media_id'));
        $newIds = array_keys($postFiles);
        $oldIds = array_keys($projectFiles);
        $createItem = array_diff($newIds, $oldIds);
        $deleteItem = array_diff($oldIds, $newIds);
        foreach ($createItem as $item) {
            $file = new Event2Media();
            $file->event_id = $model->id;
            $file->media_id = $_POST['file_id'][$item]['id'];
            $file->normal_name =  $_POST['file_id'][$item]['old_name'];
            $file->save();
        }
        Event2Media::model()->deleteAllByAttributes(array('media_id' => $deleteItem, 'event_id' => $model->id));
    }

    public function actionDelete($id){
        Event::model()->deleteByPk($id);
        $this->redirect(array('adminEvent/index'));
    }
}