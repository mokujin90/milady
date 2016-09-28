<?php
class AdminNewsController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'news';
        $this->pageCaption = 'News';
        $this->activeMenu = array('content', 'news');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new News('search');
        $model->unsetAttributes();
        if (isset($_GET['News']))
            $model->attributes = $_GET['News'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new News() : News::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest && isset($_POST['News'])) {
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            $model->preview_media_id = empty($_POST['preview_media_id']) ? null : $_POST['preview_media_id'];

            CActiveForm::validate($model);

            if($model->region_id == -1){

                $model->region_id = null;
                $model->is_portal_news = 1;
            }
            if($model->save()){
                $this->checkFiles($model);
                if(!isset($_POST['update'])){
                    $this->redirect(array('adminNews/index'));
                }
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    private function checkFiles(&$model)
    {
        $postFiles = isset($_POST['file_id']) ? $_POST['file_id'] : array();
        #получим все прешедшие id
        $projectFiles = News2Media::model()->findAllByAttributes(array('news_id' => $model->id), array('index' => 'media_id'));
        $newIds = array_keys($postFiles);
        $oldIds = array_keys($projectFiles);
        $createItem = array_diff($newIds, $oldIds);
        $deleteItem = array_diff($oldIds, $newIds);
        foreach ($createItem as $item) {
            $file = new News2Media();
            $file->news_id = $model->id;
            $file->media_id = $_POST['file_id'][$item]['id'];
            $file->normal_name =  $_POST['file_id'][$item]['old_name'];
            $file->save();
        }
        News2Media::model()->deleteAllByAttributes(array('media_id' => $deleteItem, 'news_id' => $model->id));
    }
    public function actionDelete($id){
        News::model()->deleteByPk($id);
        $this->redirect(array('adminNews/index'));
    }
}

?>
