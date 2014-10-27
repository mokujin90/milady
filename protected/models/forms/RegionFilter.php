<?php

/**
 *
 */
class RegionFilter extends CFormModel
{
    public $name = "";
    public $projectName = '';
    public $viewType = 1;
    public $placeList = array();
    public $objectList = array();
    public $investmentFormList = array();

    #слайдеры значений
    public $payback = '12;25';
    public $profit = '12;25';
    public $investSum = '12;25';
    public $returnRate = '12;25';

    #переключатели, от которых будет зависеть действенность следующих параметров
    public $isInvestment = true;
    public $isInnovative = true;
    public $isInfrastructure = true;
    public $isBusinessSale = false;
    public $isInvestPlatform = false;

    public $investmentList = array();
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
            'returnRate' => Yii::t('main','Внутреняя форма доходности (%)'),

            'isInvestment' => Yii::t('main','Инвестиционные'),
            'isInnovative' => Yii::t('main','Иновацонные'),
            'isInfrastructure' => Yii::t('main','Инфраструктурные'),
            'isBusinessSale' => Yii::t('main','Продажа бизнеса'),
            'isInvestPlatform' => Yii::t('main','Инвест площадка'),
            'isInvestPlatForm' => Yii::t('main','Форма инвестиций'),

            'investmentList' => Yii::t('main','Классификация'),
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
        $this->setAttributes($_REQUEST[CHtml::modelName($this)]);
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
            if(!empty($this->investmentList)){
                $tmpCriteria->addInCondition('investment.industry_type', $this->investmentList);
            }
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
                $tmpCriteria->addInCondition('investment.project_step', $this->innovativeList);
            }
            if(!empty($this->criticalList)){
                $tmpCriteria->addInCondition('investment.relevance_type', $this->criticalList);
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
}
