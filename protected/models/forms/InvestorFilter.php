<?php

/**
 * Class InvestorFilter
 * Фильтр по инвесторам, т.е. по определенному виду юзеровм
 */
class InvestorFilter extends CFormModel
{
    public $investorType = array();
    public $industry = array();
    public $country = array();
    public $name = '';
    public $investmentAmount = '1;5000';

    public static $investmentAmountParam = array('min' => 1, 'max' => 5000);

    public function rules()
    {
        return array();
    }

    public function init()
    {
        $range = Yii::app()->db->createCommand()
            ->select('MIN(investor_finance_amount) AS min_amount, MAX(investor_finance_amount) AS max_amount')
            ->from("User")
            ->where("is_active = 1 AND type = 'investor'")
            ->queryRow();
        self::$investmentAmountParam = array('min' => 0, 'max' => empty($range['max_amount']) ? 1 : $range['max_amount']);
        $this->investmentAmount = '0;' . (empty($range['max_amount']) ? 1 : $range['max_amount']);
    }

    public function attributeLabels()
    {
        return array(
            'investorType' => Yii::t('main', 'Тип инвестора'),
            'industry' => Yii::t('main', 'Предпочтительные отрасли'),
            'country' => Yii::t('main', 'Страна инвестора'),
            'investmentAmount' => Yii::t('main', 'Сумма финансирования (млн руб.)'),
        );
    }

    public function apply(CDbCriteria $criteria)
    {
        $this->setAttributes($_REQUEST[CHtml::modelName($this)], false);

        if (count($this->investorType) > 0) {
            $criteria->addInCondition('investor_type', $this->investorType);
        }
        if (count($this->industry) > 0) {
            $criteria->addInCondition('investor_industry', $this->industry);
        }
        if (count($this->country) > 0) {
            $criteria->addInCondition('investor_country_id', $this->country);
        }
        $investmentAmountNormal = Crud::getRange($this->investmentAmount); #нормальный вид (массив)
        if ($investmentAmountNormal['from'] == 0) {
            $criteria->addCondition('investor_finance_amount IS NULL OR (:from <= investor_finance_amount AND investor_finance_amount <= :to)');
        } else {
            $criteria->addCondition(':from <= investor_finance_amount AND investor_finance_amount <= :to ');
        }
        $criteria->params += array(':from' => $investmentAmountNormal['from'], ':to' => $investmentAmountNormal['to']);

        if (!empty($this->name)) {
            $criteriaName = new CDbCriteria();
            $criteriaName->addSearchCondition('name', $this->name, true);
            $criteriaName->addSearchCondition('company_name', $this->name, true, 'OR');
            $criteria->mergeWith($criteriaName);
        }
        return $criteria;
    }

}