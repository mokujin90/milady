<?php
class AdminParserLogController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'parserLog';
        $this->pageCaption = 'Парсинг новостей';
        $this->activeMenu = array('statistic', 'parsing');
        if(!$this->user->can('stat')) throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        return true;
    }

    public function actionIndex()
    {
        $this->updatePageSize();
        $model = new ParserLog('search');
        $model->unsetAttributes();
        if (isset($_GET[CHtml::modelName($model)]))
            $model->attributes = $_GET[CHtml::modelName($model)];

        $this->render('index', array('model' => $model));
    }
}