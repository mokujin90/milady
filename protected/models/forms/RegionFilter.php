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
    public $payback = array('from' => 15, 'to' => 25);
    public $profit = array('from' => 12, 'to' => 25);
    public $investSum = array('from' => 12, 'to' => 25);
    public $returnRate = array('from' => 12, 'to' => 25);

    #переключатели, от которых будет зависеть действенность следующих параметров
    public $isInvestment = true;
    public $isCritical = true;
    public $isInnovative = true;
    public $isInfrastructure = true;
    public $isBusinessSale = false;
    public $isBusinessRental = false;
    public $isInvestPlatform = false;
    public $isInvestForm = false;

    public $investmentList = array();
    public $criticalList = array();
    public $innovativeList = array();
    public $businessSaleList = array();
    public $businessRentalList = array();
    public $investPlatformList = array();
    public $investFormList = array();


    static $viewTypeDrop = array();
    static $objectDrop = array();
    static $investmentFormDrop = array();

    static $paybackParam = array('min' => 12, 'max' => 25);
    static $profitParam = array('min' => 12, 'max' => 25);
    static $investSumParam = array('min' => 12, 'max' => 25);
    static $returnRateParam = array('min' => 12, 'max' => 25);
    static $filter = '';

    #fake
    static $regionDrop = array('Москва', "Севастополь", "Новосибирск", "Белград");
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
            'profit' => Yii::t('main','Чистый дисконтированный доход (млн. руб)'),
            'investSum' => Yii::t('main','Сумма инвестиций (млн. руб)'),
            'returnRate' => Yii::t('main','Внутреняя форма доходности (%)'),

            'isInvestment' => Yii::t('main','Инвестиционные'),
            'isCritical' => Yii::t('main','Критические'),
            'isInnovative' => Yii::t('main','Иновацонные'),
            'isInfrastructure' => Yii::t('main','Инфраструктурные'),
            'isBusinessSale' => Yii::t('main','Продажа бизнеса'),
            'isBusinessRental' => Yii::t('main','Аренда бизнеса'),
            'isInvestPlatform' => Yii::t('main','Инвест площадка'),
            'isInvestPlatForm' => Yii::t('main','Форма инвестиций'),

            'investmentList' => Yii::t('main','Классификация'),
            'criticalList' => Yii::t('main','Критические технологии'),
            'innovativeList' => Yii::t('main','Стадия'),
            'businessSaleList' => Yii::t('main','Тип проекта'),
        );
    }


    /**
     * Инициализация модели, тут инициализируются все drop- значения для списков
     */
    public function init()
    {
        self::$viewTypeDrop = array(Yii::t('main','Списком'), Yii::t('main','Карта'));
        self::$objectDrop = array(Yii::t('main','Банки'), Yii::t('main','Инвестиционные компании'));
        self::$investmentFormDrop = array(Yii::t('main','Венчурное инвестирование'));
        self::$filter = Yii::t('main','Фильтр для выбора проекта');
    }


    public function apply()
    {

    }

}
