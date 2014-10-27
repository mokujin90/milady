<?php

class RegionController extends BaseController
{
    public function actionList(){
        $filter = new RegionFilter();
        if(Yii::app()->request->isPostRequest){
            Makeup::dump($_POST,true);
        }
        $criteria = new CDbCriteria();

        //$criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $models = Project::model()->findAll($criteria);
        $this->render('list',array('filter'=>$filter, 'models' => $models));
    }
    public function actionIndex($id=null)
    {
        $region = RegionContent::model()->findByAttributes(array('region_id' => 13));
        $this->render('index', array('region' => $region));
    }
    public function actionSocial()
    {
        $attr = array('social_overview', 'social_natural_resources', 'social_ecology', 'social_population', 'social_economy');
        $region = RegionContent::model()->findByAttributes(array('region_id' => 4));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Социальноэкономическая информация'));
    }
    public function actionInfra()
    {
        $attr = array('infra_social_object', 'infra_health', 'infra_communal', 'infra_education', 'infra_sport', 'infra_transport', 'infra_trade', 'infra_organiation_turnover', 'infra_assets_deprication');
        $region = RegionContent::model()->findByAttributes(array('region_id' => 4));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инфраструктурный паспорт'));
    }
    public function actionInnovation()
    {
        $attr = array('innovation_proportion', 'innvation_costs', 'innvation_NIOKR', 'innvation_scientific_potential');
        $region = RegionContent::model()->findByAttributes(array('region_id' => 4));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инновационный паспорт'));
    }
    public function actionInvestment()
    {
        $attr = array(' investment_climate', 'investment_banking', 'investment_support_structure', 'investment_regional');
        $region = RegionContent::model()->findByAttributes(array('region_id' => 4));
        $this->render('regionInfo', array('region' => $region, 'attr' => $attr, 'bread' => 'Инвестиционный паспорт'));
    }
}