<?php

/**
 * Ключ-значение модель
 *
 * The followings are the available columns in table 'Setting':
 * @property string $id
 * @property string $key
 * @property string $value
 */
class Setting extends CActiveRecord
{
    const START_PRICE_CLICK = 'start_price_click';
    const START_PRICE_VIEW = 'start_price_view';
    const MIN_BANNER_BALANCE = 'min_banner_balance';
    const REGION_DEFAULT = 'region_default';
    const MIN_HEIGHT_NEWS_IMAGE = 'min_height_news_image';
    const MIN_WIDTH_NEWS_IMAGE = 'min_width_news_image';

    public static $attributesProp = array(
        self::START_PRICE_VIEW => array(
            'label' => "Минимальная цена за 1000 показов баннера",
            'default' => "0,3",
            'validation' => 'double',
            'type'=>'text'
        ),
        self::START_PRICE_CLICK => array(
            'label' => "Минимальная цена за 1 клик по баннеру",
            'default' => "0,3",
            'validation' => 'double',
            'type'=>'text'
        ),
        self::MIN_BANNER_BALANCE => array(
            'label' => "Минимальный баланс для баннера",
            'default' => "1500",
            'validation' => 'double',
            'type'=>'text'
        ),
        self::REGION_DEFAULT => array(
            'label' => 'Регион по умолчанию',
            'default' => "13",
            'type'=>'select',
            'option'=>'region'
        ),
        self::MIN_WIDTH_NEWS_IMAGE => array(
            'label' => 'Миниамальная ширина изображения в новостях',
            'default' => "720",
            'type'=>'double',
            'option'=>'text'
        ),
        self::MIN_HEIGHT_NEWS_IMAGE => array(
            'label' => 'Миниамальная высота изображения в новостях',
            'default' => "290",
            'type'=>'double',
            'option'=>'text'
        ),
    );

    /**
     * Загрузить все параметры, которые есть в массиве и в базе и выдать одним массивом AR
     * @return Setting[]
     */
    public function load()
    {
        $models = self::model()->findAllByAttributes(array('key' => array_keys(self::$attributesProp)), array('index' => 'key'));

        foreach (self::$attributesProp as $key => $prop) {
            if (array_key_exists($key, $models))
                continue;
            $virtual = new self();
            $virtual->attributes = array('key' => $key, 'value' => self::$attributesProp[$key]['default']);
            $models[$key] = $virtual;
        }
        return $models;
    }

    /**
     * @param $request массив с постом, вида [[ключ=>значение][ключ=>значение]]
     */
    public static function saveSetting($request)
    {
        $error = array();
        if (!is_array($request))
            return false;
        $models = self::load();

        foreach (self::$attributesProp as $key => $prop) {
            if (array_key_exists($key, $request)) { #поле изменилось и пришло
                $models[$key]->value = $request[$key];
                if ($models[$key]->validation()) {
                    $models[$key]->save();
                } else {
                    $error[] = $key;
                }
            }
        }
        return $error;
    }

    /**
     * Метод, который изобразит как надо каждое из свойств
     */
    public function draw($isValid = true)
    {
        $attrSetting = array_key_exists($this->key, self::$attributesProp) ? self::$attributesProp[$this->key] : array();
        $html = CHtml::label(count($attrSetting) ? $attrSetting['label'] : $this->key, '', array('class' => "col-xs-12 col-sm-4 control-label"));
        $addClass = $isValid ? '' : 'error';
        switch ($attrSetting['type']) {
            case "select":
                if($attrSetting['option']=='region'){
                    $data = Region::getDrop();
                }
                $html .= CHtml::dropDownList("Setting[{$this->key}]",$this->value,$data, array('class' => "form-control $addClass"));
                break;
            default:
                $html .= CHtml::textField("Setting[{$this->key}]", $this->value, array('class' => "form-control $addClass"));
        }
        return $html;
    }

    /**
     * Геттер для любого свойства. Сначало возьмет из базы, а если не найдет - то из дефолтного значения
     * @param $key
     */
    public static function get($key, $default = false)
    {
        $model = self::model()->findByAttributes(array('key' => $key));
        if ($model)
            return $model->value;
        elseif (array_key_exists($key, self::$attributesProp))
            return self::$attributesProp[$key]['default'];
        else
            return $default;
    }

    /**
     * Сеттер
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $model = self::model()->findByAttributes(array('key' => $key));
        if ($model)
            $model->value = $value;
        else {
            $model = new self();
            $model->attributes = array('key' => $key, 'value' => $value);
        }
        return $model->save();
    }

    /**
     * Валидация каждой записи, согласно массиву с параметрами
     * @return bool
     */
    private function validation()
    {
        if (empty(self::$attributesProp[$this->key]['validation']))
            return true;
        switch (self::$attributesProp[$this->key]['validation']) {
            case "double":
                return (boolean)preg_match('/^[-+]?([0-9]*\.)?[0-9]+([eE][-+]?[0-9]+)?$/', trim($this->value));
        }
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Setting';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('key', 'required'),
            array('key', 'length', 'max' => 255),
            array('value', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, key, value', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('key', $this->key, true);
        $criteria->compare('value', $this->value, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Setting the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
