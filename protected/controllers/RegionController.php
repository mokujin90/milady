<?php

class RegionController extends BaseController
{

    public function actionIndex()
    {
        if(!$region = RegionContent::model()->findByAttributes(array('region_id' => $this->currentRegion))){
            throw new CHttpException(404, Yii::t('yii', 'Заполните регион в админе'));
        }

        $newsCriteria = new CDbCriteria();
        $newsCriteria->addColumnCondition(array('is_active' => 1, 'region_id' => $this->currentRegion));
        $newsCriteria->order='create_date DESC';
        $newsCriteria->limit = 3;
        $news = News::model()->findAll($newsCriteria);

        $projects = Project::model()->findAllByAttributes(array('region_id'=>$this->currentRegion));

        $this->render('index', array('region' => $region,'projects'=>$projects, 'news' => $news));

    }
    public function actionSocial()
    {
        $attr = array('social_overview', 'social_natural_resources', 'social_ecology', 'social_population', 'social_economy');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $this->currentRegion));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Социальноэкономическая информация'));
    }
    public function actionInfra()
    {
        $attr = array('infra_social_object', 'infra_health', 'infra_communal', 'infra_education', 'infra_sport', 'infra_transport', 'infra_trade', 'infra_organiation_turnover', 'infra_assets_deprication');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $this->currentRegion));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инфраструктурный паспорт'));
    }
    public function actionInnovation()
    {
        $attr = array('innovation_proportion', 'innvation_costs', 'innvation_NIOKR', 'innvation_scientific_potential');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $this->currentRegion));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инновационный паспорт'));
    }
    public function actionInvestment()
    {
        $attr = array(' investment_climate', 'investment_banking', 'investment_support_structure', 'investment_regional');
        $region = RegionContent::model()->findByAttributes(array('region_id' => $this->currentRegion));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инвестиционный паспорт'));
    }
}