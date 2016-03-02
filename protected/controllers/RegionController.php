<?php

class RegionController extends BaseController
{
    public $layout = "region";
    public $defaultSection = 'social';
    /**
     * @var Region
     */
    public $model;
    public $params = array();
    public $defaultAction = "list";
    public function actionList()
    {
        $this->breadcrumbs = array('Регионы');
        $models = District::model()->with('regions')->findAll(array('order' => 't.id'));
        $this->render('list', array('models' => $models));
    }

    public function actionSocial($id=null)
    {

        $this->setRegion($id,'Социально-экономическая инфорация');

        $newsCriteria = new CDbCriteria();
        $newsCriteria->addColumnCondition(array('is_active' => 1, 'region_id' => $this->model->region->id));
        $newsCriteria->order = 'create_date DESC';
        $newsCriteria->limit = 3;
        $news = News::model()->findAll($newsCriteria);

        $projects = Project::model()->findAllByAttributes(array('status' => 'approved', 'region_id' => $this->model->region->id));

        $this->render('social', array('region' => $this->model, 'projects' => $projects, 'news' => $news));

    }

    public function actionInfrastructure($id=null)
    {
        $this->setRegion($id,'Инфраструктурный паспорт');
        $this->render('infrastructure', array('region' => $this->model));
    }

    public function actionInnovative($id=null)
    {
        $this->setRegion($id,'Инновационный паспорт');
        $proofs= RegionProof::findByRegion($this->model->region->id);
        $this->render('innovative', array('region' => $this->model,'proofs'=>$proofs));
    }

    public function actionInvest($id=null)
    {
        $this->setRegion($id,'Инвестиционный паспорт');
        $criteria = new CDbCriteria();
        $criteria->index = 'attr';
        $criteria->addColumnCondition(array('region_id'=>$this->model->region->id));
        $proofs= RegionProof::model()->findAll($criteria);
        $this->render('invest', array('region' => $this->model,'proofs'=>$proofs));
    }

    public function actionAnalytic($id=null)
    {
        $this->setRegion($id,'Региональная аналитика');
        $this->render('analytics', array('region' => $this->model));
    }

    public function actionLaw($id=null)
    {
        $this->setRegion($id,'Региональное законодательство');
        $criteria = new CDbCriteria();
        $criteria->order='create_date DESC';
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('division_id', $_GET['hide']);
        }
        $criteria->addColumnCondition(array('region_id'=>$this->model->region->id));
        $lawFiles = Law::model()->findAll($criteria);
        $this->render('law', array('region' => $this->model,'files'=>$lawFiles));
    }

    private function setRegion($id,$name){
        if(is_null($id))
            $id = $this->getCurrentRegion();
        $this->model = RegionContent::model()->findByAttributes(array('region_id' => $id));
        if (!$this->model) {
            throw new CHttpException(404, Yii::t('main', 'Информация о регионе не найдена'));
        }
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$this->model->region->name}" => $this->createUrl('region/social', array('id' => $id)), $name);
    }
}