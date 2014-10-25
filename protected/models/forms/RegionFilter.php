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
        self::$viewTypeDrop = array(Yii::t('main', 'Списком'), Yii::t('main', 'Карта'));
        self::$objectDrop = array(Yii::t('main', 'Банки'), Yii::t('main', 'Инвестиционные компании'));
        self::$investmentFormDrop = array(Yii::t('main', 'Венчурное инвестирование'));
        self::$filter = Yii::t('main', 'Фильтр для выбора проекта');
    }

    /**
     * Переопределим стандартный сеттер, добавив туда поддержку тех параметров, которые изменились,
     * при этом присваивание всегда небезопасное (фильтр же)
     */
    public function setAttributes($values)
    {
        $this->setEditableAttributes($values);
        parent::setAttributes($values,false);
    }

    /**
     * Вся логика фильтра изменение критерии таким способом, чтобы выполнив её можно было получить данные с пагинацией
     */
    public function apply()
    {
        $this->setAttributes($_REQUEST[CHtml::modelName($this)]);
    }


    /**
     * Вернуть массив с измененными полями
     */
    public function getEditableAttributes()
    {
        $result = array();
        $rangeAttributes = array('payback','profit','investSum','returnRate');
        foreach($this->editableAttributes as $name => $value){
            #для массивов обработка чуть сложнее
            if(is_array($this->$name)){
                if($name == 'placeList'){//для региона запрсим отдельную таблицу
                    $result[] = implode(', ',CHtml::listData(Region::model()->findAllByAttributes(array('id'=>$value)),'id','name'));
                }
                elseif(isset($this->{$name."Drop"})){
                    //$result[]
                }
            }
            else{
                $result[] = $this->getAttributeLabel($name);
            }

        }
        return $result;
    }

    /**
     * Метод, который определит какие параметры менялись, а какие нет.
     * @param $name
     * @param $value
     */
    private function setEditableAttributes($values){

        $exclusionAttributes = array(); // аттрибуты изменение которых не записывается
        $attributes = array_flip($this->attributeNames());
        foreach ($values as $name => $value) {
            if (isset($attributes[$name])) {
                if ($this->$name != $value) { //перед присваиваниями занесем новые измененные данные в массив
                    $this->editableAttributes[$name] = $value;
                }
            }
        }
    }
}
