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

        if (Yii::app()->request->isPostRequest && isset($_POST[CHtml::modelName($model)])) {
            $model->attributes = $_POST[CHtml::modelName($model)];
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminContent/index'));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

}