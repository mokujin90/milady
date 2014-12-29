<?php

class RegionController extends BaseController
{

    public function actionIndex($id)
    {
        if(!$region = RegionContent::model()->findByAttributes(array('region_id' => $id))){
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), $region->region->name);

        $newsCriteria = new CDbCriteria();
        $newsCriteria->addColumnCondition(array('is_active' => 1, 'region_id' => $id));
        $newsCriteria->order='create_date DESC';
        $newsCriteria->limit = 3;
        $news = News::model()->findAll($newsCriteria);

        $projects = Project::model()->findAllByAttributes(array('region_id'=>$id));

        $this->render('index', array('region' => $region,'projects'=>$projects, 'news' => $news));

    }

    public function actionSocial($id)
    {
        $attr = array('social_overview', 'social_natural_resources', 'social_ecology', 'social_population', 'social_economy');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $id));
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$region->region->name}" =>$this->createUrl('region/index', array('id' => $id)), 'Социальноэкономическая информация');
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Социальноэкономическая информация'));
    }

    public function actionInfra($id)
    {
        $attr = array('infra_social_object', 'infra_health', 'infra_communal', 'infra_education', 'infra_sport', 'infra_transport', 'infra_trade', 'infra_organiation_turnover', 'infra_assets_deprication');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $id));
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$region->region->name}" =>$this->createUrl('region/index', array('id' => $id)), 'Инфраструктурный паспорт');
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инфраструктурный паспорт'));
    }

    public function actionInnovation($id)
    {
        $attr = array('innovation_proportion', 'innvation_costs', 'innvation_NIOKR', 'innvation_scientific_potential');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $id));
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$region->region->name}" =>$this->createUrl('region/index', array('id' => $id)), 'Инновационный паспорт');
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инновационный паспорт'));
    }

    public function actionInvestment($id)
    {
        $attr = array('investment_climate', 'investment_banking', 'investment_support_structure', 'investment_regional');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $id));
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$region->region->name}" =>$this->createUrl('region/index', array('id' => $id)), 'Инвестиционный паспорт');
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr));
    }

    public function actionAnalytics($id)
    {
        $region = RegionContent::model()->findByAttributes(array('region_id' => $id));
        $this->breadcrumbs = array('Регионы' => $this->createUrl('region/list'), "{$region->region->name}" =>$this->createUrl('region/index', array('id' => $id)), 'Региональная аналитика');
        $this->render('analytics', array('region' => $region));
    }

    public function actionList()
    {
        $this->breadcrumbs = array('Регионы');
        $models = District::model()->with('regions')->findAll(array('order' => 't.id'));
        $this->render('list', array('models' => $models));
    }
}