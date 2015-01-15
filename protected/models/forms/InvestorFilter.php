<?php

/**
 * Class InvestorFilter
 * Фильтр по инвесторам, т.е. по определенному виду юзеровм
 */
class InvestorFilter extends CFormModel{
    public $investorType = array();
    public $industry = array();
    public $country = array();
    public $investmentAmount = '1;5000';

    public static $investmentAmountParam = array('min' => 1, 'max' => 5000);
    public function rules()
    {
        return array();
    }

    public function attributeLabels()
    {
        return array(
            'investorType' => Yii::t('main','Тип инвестора'),
            'industry' => Yii::t('main','Предпочтительные отрасли'),
            'country' => Yii::t('main','Страна инвестора'),
            'investmentAmount' => Yii::t('main','Сумма финансирования (млн. руб.)'),
        );
    }

    public function apply(CDbCriteria $criteria){
        $this->setAttributes($_REQUEST[CHtml::modelName($this)],false);

        if(count($this->investorType)>0){
            $criteria->addInCondition('investor_type',$this->investorType);
        }
        if(count($this->industry)>0){
            $criteria->addInCondition('investor_industry',$this->industry);
        }
        if(count($this->country)>0){
            $criteria->addInCondition('investor_country_id',$this->country);
        }
        $investmentAmountNormal = Crud::getRange($this->investmentAmount); #нормальный вид (массив)
        $criteria->addCondition(':from < investor_finance_amount AND investor_finance_amount < :to ');
        $criteria->params += array(':from'=>$investmentAmountNormal['from'],':to'=>$investmentAmountNormal['to']);
        return $criteria;
    }

}