<?php
class AdminContentController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'content';
        $this->pageCaption = 'Контент';
        $this->activeMenu = array('content', 'stat-content');
        if(!$this->user->can('content')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $model = new Content('search');
        $model->unsetAttributes();
        if (isset($_GET['Content']))
            $model->attributes = $_GET['Content'];

        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id = null)
    {
        $model = is_null($id) ? new Content() : Content::model()->findByPk($id);
        if(is_null($model->type)&& $model->system_type == 'default' ){
            $model->scenario = 'create';
        }
        if($model->system_type == 'contacts'){
            if(!$model->contacts){
                $model->contacts = new PageContacts();
                $model->contacts->page_id = $model->id;
                $model->contacts->lon = 0;
                $model->contacts->lat = 0;
            }
            if(isset($_POST['PageContacts'])){
                $model->contacts->lon = $_POST['PageContacts']['lon'];
                $model->contacts->lat = $_POST['PageContacts']['lat'];
                $model->contacts->save();
            }
        }

        if (Yii::app()->request->isPostRequest && isset($_POST[CHtml::modelName($model)])) {
            $model->attributes = $_POST[CHtml::modelName($model)];
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminContent/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }


    public function actionDelete($id){
        if($content = Content::model()->findByPk($id)){
            if(is_null($content->type) && $content->system_type == 'default'){
                $content->delete();
            }
        }
        $this->redirect(array('adminContent/index'));
    }

}