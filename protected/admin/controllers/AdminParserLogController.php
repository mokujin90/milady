<?php
class AdminParserLogController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'parserLog';
        $this->pageCaption = 'Парсинг новостей';
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