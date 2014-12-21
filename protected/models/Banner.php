<?php

/**
 * This is the model class for table "Banner".
 *
 * The followings are the available columns in table 'Banner':
 * @property string $id
 * @property string $user_id
 * @property string $media_id
 * @property string $status
 * @property string $create_date
 * @property string $url
 * @property string $region_id
 * @property string $count_view
 * @property string $price
 * @property string $count_click
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Media $media
 * @property Region $region
 * @property User $user
 */
class Banner extends ActiveRecord
{
    //процент для расчета рекомендуемой цены
    const PERCENT_RECOMMEND_CLICK = 0.1;
    const PERCENT_RECOMMEND_VIEW = 0.2;

    const START_PRICE_CLICK = 1;
    const START_PRICE_VIEW = 30;

    const VIEW_MIN_PRICE = 1000;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Banner';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, media_id, status, create_date, url, price, type,region_id', 'required'),
            array('user_id, media_id, status, region_id, count_view, price, count_click', 'length', 'max' => 10),
            array('price', 'numerical'),
            array('url', 'url'),
            array('type', 'length', 'max' => 5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, media_id, status, create_date, url, region_id, count_view, price, count_click, type', 'safe', 'on' => 'search'),
        );
    }

    public function beforeValidate()
    {
        if ($this->price == 0) {
            $this->addError('price', Yii::t('main', 'Цена не может быть равна нулю'));
        }
        return parent::beforeValidate();
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'media' => array(self::BELONGS_TO, 'Media', 'media_id'),
            'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => Yii::t('main', 'Пользователь'),
            'media_id' => Yii::t('main', 'Изображение'),
            'status' => Yii::t('main', 'Статус
            '),
            'create_date' => 'Create Date',
            'url' => 'Url',
            'region_id' => Yii::t('main', 'Регион'),
            'count_view' => Yii::t('main', 'Количество просмотров'),
            'price' => Yii::t('main', 'Цена'),
            'count_click' => Yii::t('main', 'Количество кликов'),
            'type' => Yii::t('main', 'Оплата за'),
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
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('media_id', $this->media_id, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('count_view', $this->count_view, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('count_click', $this->count_click, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Banner the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function statusList($id = null)
    {
        $array = array(
            'moderation' => Yii::t('main', 'На модерации'),
            'blocked' => Yii::t('main', 'Неактивен'),
            'activate' => Yii::t('main', 'Активен'),
        );
        return is_null($id) ? $array : $array[$id];
    }

    public static function typeList($id = null)
    {
        $types = array(
            'view' => Yii::t('main', 'Плата за просмотры'),
            'click' => Yii::t('main', 'Плата за клики')
        );
        return is_null($id) ? $types : $types[$id];
    }

    /**
     * Выдать рекомендуемую цену за выбранную услугу по региону
     * @param $region
     */
    public static function getRecommendPrice($type, $region)
    {
        #найдем в выбранном регионе
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('region_id' => $region, 'type' => $type));
        $criteria->order = 'price DESC';
        $model = self::model()->find($criteria);
        if (!$model) {
            return $type == 'click' ? self::START_PRICE_CLICK : self::START_PRICE_VIEW;
        }
        return $model->price;
    }

    /**
     * Выдать случный (по цене) набор баннеров
     * @param $regionId
     * @return Banner[]
     */
    public static function findActiveBanner($regionId)
    {
        $result = array();
        define(BANNER_COUNT, 4); #максимальное количество баннеров
        $count = 0;
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.status = "activate" AND t.region_id = :region_id');
        $criteria->with = array('user.balances');
        $criteria->addCondition('( balances.value >= t.price && t.type = "click")
            || (t.type = "view" && ((t.count_view % 1000 = 0 && balances.value >= t.price) || (t.count_view % 1000 !=0)) )');
        $criteria->params += array(':region_id' => $regionId);
        $criteria->order = 't.price DESC';
        $criteria->index = 'id';
        $banners = self::model()->findAll($criteria);
        if (count($banners) <= BANNER_COUNT) { #дальше не нужно высчитывать
            $result = $banners;
        } else {
            $weights = CHtml::listData($banners, 'id', 'price');
            foreach ($banners as $key => $banner) {
                $count++;
                $element = Candy::rand_by_weight($banners, $weights);
                unset($weights[$element->id]);
                unset($weights[$element->id]);
                $result[] = $element;
                if ($count == BANNER_COUNT) {
                    break;
                }
            }
        }
        return $result;
    }

    public function addView()
    {
        if ($this->type == 'view' && $this->count_view % self::VIEW_MIN_PRICE == 0) {
            Balance::pay($this->user_id, $this->price,'view_banner');
        }
        $this->count_view += 1;
        $this->save();
    }

    public function addClick()
    {
        if ($this->type == 'click') {
            Balance::pay($this->user_id, $this->price,'click_banner');
        }
        $this->count_click += 1;
        $this->save();
    }
}
