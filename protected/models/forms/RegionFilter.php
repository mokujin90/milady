<?php

/**
 *
 */
class RegionFilter extends CFormModel
{
    public $name = "";
    public $projectName = '';
    public $viewType = 0;
    public $placeList = array();
    public $objectList = array();
    public $investmentFormList = array();

    #слайдеры значений
    public $payback = '0;999999999999999';
    public $profit = '0;999999999999999';
    public $investSum = '0;999999999999999';
    public $returnRate = '0;999999999999999';

    #переключатели, от которых будет зависеть действенность следующих параметров
    public $isInvestment = true;
    public $isInnovative = true;
    public $isInfrastructure = true;
    public $isBusinessSale = false;
    public $isInvestPlatform = false;

    //public $investmentList = array();
    public $criticalList = array();
    public $innovativeList = array();
    public $infrastructureList = array();

    /**
     * Параметры, списки для фильтра
     * @var array
     */
    static $viewTypeDrop = array();
    static $objectDrop = array();
    static $investmentFormDrop = array();

    static $paybackParam = array('min' => 12, 'max' => 25);
    static $profitParam = array('min' => 12, 'max' => 25);
    static $investSumParam = array('min' => 12, 'max' => 25);
    static $returnRateParam = array('min' => 12, 'max' => 25);
    static $filter = '';

    private $editableAttributes = array(); // измененые атрибуты для короткой формы фильтра

    public function rules()
    {
        return array();
    }

    public function attributeLabels()
    {
        return array(
            'name' => Yii::t('main','Название компании'),
            'projectName' => Yii::t('main','Название проекта'),
            'placeList' => Yii::t('main','Место реализации'),
            'objectList' => Yii::t('main','Тип объектов'),
            'investmentFormList' => Yii::t('main','Форма инвестирования'),

            'payback' => Yii::t('main','Срок окупаемости (лет)'),
            'profit' => Yii::t('main','Чистый дисконтный доход (млн. руб)'),
            'investSum' => Yii::t('main','Сумма инвестиций (млн. руб)'),
            'returnRate' => Yii::t('main','Внутреняя норма доходности (%)'),

            'isInvestment' => Yii::t('main','Инвестиционные'),
            'isInnovative' => Yii::t('main','Инновацонные'),
            'isInfrastructure' => Yii::t('main','Инфраструктурные'),
            'isBusinessSale' => Yii::t('main','Продажа бизнеса'),
            'isInvestPlatform' => Yii::t('main','Инвестиционная площадка'),
            'isInvestPlatForm' => Yii::t('main','Форма инвестиций'),

            //'investmentList' => Yii::t('main','Классификация'),
            'criticalList' => Yii::t('main','Критические технологии'),
            'innovativeList' => Yii::t('main','Стадия'),
            'infrastructureList' => Yii::t('main','Тип проекта'),
        );
    }

    /**
     * Инициализация модели, тут инициализируются все drop- значения для списков
     */
    public function init()
    {
        $range = Yii::app()->db->createCommand()
            ->select('MIN(investment_sum) AS min_investment_sum, MAX(investment_sum) AS max_investment_sum, MIN(period) AS min_period, MAX(period) AS max_period, MIN(profit_norm) AS min_profit_norm, MAX(profit_norm) AS max_profit_norm, MIN(profit_clear) AS min_profit_clear, MAX(profit_clear) AS max_profit_clear')
            ->from("Project")
            ->queryRow();
        self::$paybackParam = array('min' => empty($range['min_period']) ? 1 : $range['min_period'], 'max' => empty($range['max_period']) ? 1 : $range['max_period']);
        self::$profitParam = array('min' => empty($range['min_profit_clear']) ? 1 : $range['min_profit_clear'], 'max' => empty($range['max_profit_clear']) ? 1 : $range['max_profit_clear']);
        self::$investSumParam = array('min' => empty($range['min_investment_sum']) ? 1 : $range['min_investment_sum'], 'max' => empty($range['max_investment_sum']) ? 1 : $range['max_investment_sum']);
        self::$returnRateParam = array('min' => empty($range['min_profit_norm']) ? 1 : $range['min_profit_norm'], 'max' => empty($range['max_profit_norm']) ? 1 : $range['max_profit_norm']);

        $this->setShortForm();
        self::$viewTypeDrop = array(Yii::t('main', 'Списком'), Yii::t('main', 'Карта'));
        self::$objectDrop = array(Yii::t('main', 'Банки'), Yii::t('main', 'Инвестиционные компании'));
        self::$investmentFormDrop = array(Yii::t('main', 'Венчурное инвестирование'));
        self::$filter = Yii::t('main', 'Фильтр для выбора проекта');
    }

    /**
     * Инициализация той или иной формы фильтра. После вызова метода доступен будет атрибут shortForm
     * @param $isShort
     */
    public function setShortForm($isShort=true){
        Yii::app()->clientScript->registerScript('filter-init', 'filter.init();', CClientScript::POS_READY);
        $this->shortForm = $isShort;
        if($this->shortForm){
            Yii::app()->clientScript->registerCss('filter','.full-form{display:none;}');
            Yii::app()->clientScript->registerScript('filter', 'filter.showShort();', CClientScript::POS_READY);
        }
        else{
            Yii::app()->clientScript->registerCss('filter','.full-form{display:block;}');
            Yii::app()->clientScript->registerScript('filter', 'filter.hideShort();', CClientScript::POS_READY);
        }
    }
    /**
     * Переопределим стандартный сеттер, добавив туда поддержку тех параметров, которые изменились,
     * при этом присваивание всегда небезопасное (фильтр же)
     */
    public function setAttributes($values)
    {
        //$this->setEditableAttributes($values);
        parent::setAttributes($values,false);
    }

    /**
     * Вся логика фильтра изменение критерии таким способом, чтобы выполнив её можно было получить данные с пагинацией
     */
    public function apply()
    {
        if(isset($_REQUEST[CHtml::modelName($this)])){
            $this->setAttributes($_REQUEST[CHtml::modelName($this)]);
        }
    }

    public function getCriteria(){
        $criteria = new CDbCriteria();
        $with = array();
        if(!($this->isInvestment || $this->isInnovative || $this->isInfrastructure || $this->isInvestPlatform || $this->isBusinessSale)){
            $criteria->addColumnCondition(array('t.type' => 0));
            return $criteria;
        }
        if($this->isInvestment){
            $tmpCriteria = new CDbCriteria();
            $tmpCriteria->addColumnCondition(array('t.type' => Project::T_INVEST));
            array_push($with, 'investment');
            /*if(!empty($this->investmentList)){
                $tmpCriteria->addInCondition('investment.industry_type', $this->investmentList);
            }*/
            if(!empty($this->investmentFormList)){
                $tmpCriteria->addInCondition('investment.investment_form', $this->investmentFormList);
            }
            $criteria->mergeWith($tmpCriteria, 'OR');
        }
        if($this->isInnovative){
            $tmpCriteria = new CDbCriteria();
            $tmpCriteria->addColumnCondition(array('t.type' => Project::T_INNOVATE));
            array_push($with, 'innovative');
            if(!empty($this->innovativeList)){
                $tmpCriteria->addInCondition('innovative.project_step', $this->innovativeList);
            }
            if(!empty($this->criticalList)){
                $tmpCriteria->addInCondition('innovative.relevance_type', $this->criticalList);
            }
            $criteria->mergeWith($tmpCriteria, 'OR');
        }
        if($this->isInfrastructure){
            $tmpCriteria = new CDbCriteria();
            $tmpCriteria->addColumnCondition(array('t.type' => Project::T_INFRASTRUCT));
            array_push($with, 'infrastructure');
            if(!empty($this->infrastructureList)){
                $tmpCriteria->addInCondition('infrastructure.type', $this->infrastructureList);
            }
            $criteria->mergeWith($tmpCriteria, 'OR');
        }
        if($this->isInvestPlatform){
            $tmpCriteria = new CDbCriteria();
            $tmpCriteria->addColumnCondition(array('t.type' => Project::T_SITE));
            //array_push($with, 'investmentSite');
            $criteria->mergeWith($tmpCriteria, 'OR');
        }
        if($this->isBusinessSale){
            $tmpCriteria = new CDbCriteria();
            $tmpCriteria->addColumnCondition(array('t.type' => Project::T_BUSINESS));
            //array_push($with, 'businesses');
            $criteria->mergeWith($tmpCriteria, 'OR');
        }
        if(!empty($this->projectName)){
            $criteria->addSearchCondition('t.name', $this->projectName);
        }
        if(!empty($this->name)){
            array_push($with, 'user');
            $criteria->addSearchCondition('user.company_name', $this->name);
        }
        if(!empty($this->placeList)){
            $criteria->addInCondition('t.region_id', $this->placeList);
        }
        if(!empty($this->objectList)){
            $criteria->addInCondition('t.object_type', $this->objectList);
        }

        $payback = explode(';', $this->payback);
        $profit = explode(';', $this->profit);
        $investSum = explode(';', $this->investSum);
        $returnRate = explode(';', $this->returnRate);
        $criteria->addCondition("(t.type = :invest_site OR (
        (t.period >= :min_period AND t.period <= :max_period) AND
        (t.profit_clear >= :min_profit_clear AND t.profit_clear <= :max_profit_clear) AND
        (t.investment_sum >= :min_investment_sum AND t.investment_sum <= :max_investment_sum) AND
        (t.profit_norm >= :min_profit_norm AND t.profit_norm <= :max_profit_norm)
        ))");
        $criteria->params += array(
            ':min_period' => isset($payback[0]) ? $payback[0] : 0,
            ':max_period' => isset($payback[1]) ? $payback[1] : 99999,
            ':min_profit_clear' => isset($profit[0]) ? $profit[0] : 0,
            ':max_profit_clear' => isset($profit[1]) ? $profit[1] : 99999,
            ':min_investment_sum' => isset($investSum[0]) ? $investSum[0] : 0,
            ':max_investment_sum' => isset($investSum[1]) ? $investSum[1] : 99999,
            ':min_profit_norm' => isset($returnRate[0]) ? $returnRate[0] : 0,
            ':max_profit_norm' => isset($returnRate[1]) ? $returnRate[1] : 99999,
            ':invest_site' => Project::T_SITE,
        );
        $criteria->with = $with;

        /*

        #слайдеры значений
        public $payback = '12;25';
        public $profit = '12;25';
        public $investSum = '12;25';
        public $returnRate = '12;25';

        public $is = true;
        public $ = true;
        public $isBusinessSale = false;
        public $isInvestPlatform = false;
*/

        return $criteria;

    }

    /**
     * Вернуть массив с измененными полями
     */
    /*public function getEditableAttributes()
    {

        $result = array();
        $rangeAttributes = array('payback','profit','investSum','returnRate');
        foreach($this->editableAttributes as $name => $value){
            #для массивов обработка чуть сложнее
            if(is_array($this->$name)){
                if($name == 'placeList'){//для региона запрсим отдельную таблицу
                    $result[] = implode(', ',CHtml::listData(Region::model()->findAllByAttributes(array('id'=>$value)),'id','name'));
                }
                elseif(isset(self::${$name."Drop"})){
                }
            }
            else{
                $result[] = $this->getAttributeLabel($name);
            }

        }
        return $result;
    }*/

    /**
     * Метод, который определит какие параметры менялись, а какие нет.
     * Просто из $_GET'a достанем нужные элементы
     * @param $name
     * @param $value
     */
    /*private function setEditableAttributes($values){
        $exclusionAttributes = array(); // аттрибуты изменение которых не записывается
        $attributes = array_flip($this->attributeNames());
        foreach ($values as $name => $value) {
            if (isset($attributes[$name])) {
                if ($this->$name != $value) { //перед присваиваниями занесем новые измененные данные в массив
                    $this->editableAttributes[$name] = $value;
                }
            }
        }
    }*/

    /**
     * Установить включенные типы проектов по выбрнному id типа
     * @param $typeId
     */
    public function setProjectTypeById($typeId){
        $drop = array(
            Project::T_INVEST => Yii::t('main', 'Инвестиционный проект'),
            Project::T_INNOVATE => Yii::t('main', 'Инновационный проект'),
            Project::T_INFRASTRUCT => Yii::t('main', 'Инфраструктурный проект'),
            Project::T_SITE => Yii::t('main', 'Инвестиционная площадка'),
            Project::T_BUSINESS => Yii::t('main', 'Продажа бизнеса'),
        );

        if(is_null($typeId)){
            $this->setAttributes(array('isInvestment'=>true,'isInnovative'=>true,'isInfrastructure'=>true,'isBusinessSale'=>true,'isInvestPlatform'=>true));
            return false;
        }
        $this->setAttributes(array('isInvestment'=>false,'isInnovative'=>false,'isInfrastructure'=>false,'isBusinessSale'=>false,'isInvestPlatform'=>false));
        switch ($typeId) {
            case Project::T_INVEST:
                $this->isInvestment = true;
                break;
            case Project::T_INNOVATE:
                $this->isInnovative = true;
                break;
            case Project::T_INFRASTRUCT:
                $this->isInfrastructure = true;
                break;
            case Project::T_SITE:
                $this->isInvestPlatform = true;
                break;
            case Project::T_BUSINESS:
                $this->isBusinessSale = true;
                break;
        }
    }
}
