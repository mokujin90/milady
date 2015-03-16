<?php

class RegionController extends BaseController
{
    public $layout = "region";
    public $defaultSection = 'social';
    private $model;
    public $params = array();
    public $defaultAction = "list";
    public function actionList()
    {
        $this->breadcrumbs = array('Регионы');
        $models = District::model()->with('regions')->findAll(array('order' => 't.id'));
        $this->render('list', array('models' => $models));
    }

    public function actionSocial($id)
    {

        $this->setRegion($id,'Социально-экономическая инфорация');

        $newsCriteria = new CDbCriteria();
        $newsCriteria->addColumnCondition(array('is_active' => 1, 'region_id' => $id));
        $newsCriteria->order = 'create_date DESC';
        $newsCriteria->limit = 3;
        $news = News::model()->findAll($newsCriteria);

        $projects = Project::model()->findAllByAttributes(array('region_id' => $id));

        $this->render('social', array('region' => $this->model, 'projects' => $projects, 'news' => $news));

    }

    public function actionInfrastructure($id)
    {
        $this->setRegion($id,'Инфраструктурный паспорт');
        $this->render('infrastructure', array('region' => $this->model));
    }

    public function actionInnovative($id)
    {
        $this->setRegion($id,'Инновационный паспорт');
        $this->render('innovative', array('region' => $this->model));
    }

    public function actionInvest($id)
    {
        $this->setRegion($id,'Инвестиционный паспорт');
        $this->render('invest', array('region' => $this->model));
    }

    public function actionAnalytic($id)
    {
        $this->setRegion($id,'Региональная аналитика');
        $this->render('analytics', array('region' => $this->model));
    }

    public function actionLaw($id)
    {
        $this->setRegion($id,'Региональное законодательство');
        $this->render('law', array('region' => $this->model));
    }

    private function setRegion($id,$name){
        $this->model = RegionContent::model()->findByAttributes(array('region_id' => $id));
        if (!$this->model) {
            throw new CHttpException(404, Yii::t('main', 'Информация о регионе не найдена'));
        }
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$this->model->region->name}" => $this->createUrl('region/index', array('id' => $id)), $name);
    }
}