<?php

/**
 * Class InvestorFilter
 * Фильтр по инвесторам, т.е. по определенному виду юзеровм
 */
class InvestorFilter extends CFormModel{
    public $investorType = -1;
    public $industry = -1;
    public $country = -1;
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
        if($this->investorType != -1){
            $criteria->addColumnCondition(array('investor_type'=>$this->investorType));
        }
        if($this->industry != -1){
            $criteria->addColumnCondition(array('investor_industry'=>$this->industry));
        }
        if($this->country != -1){
            $criteria->addColumnCondition(array('investor_country_id'=>$this->country));
        }
        $investmentAmountNormal = Crud::getRange($this->investmentAmount); #нормальный вид (массив)
        $criteria->addCondition(':from < investor_finance_amount AND investor_finance_amount < :to ');
        $criteria->params += array(':from'=>$investmentAmountNormal['from'],':to'=>$investmentAmountNormal['to']);
        return $criteria;
    }

}