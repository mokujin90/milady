<?php

/**
 * This is the model class for table "Banner".
 *
 * The followings are the available columns in table 'Banner':
 * @property string $id
 * @property string $user_id
 * @property string $media_id
 * @property string $status
 * @property string $url
 * @property string $region_id
 * @property string $price
 * @property double $balance
 * @property string $type
 * @property string $user_show
 * @property string $day_show
 * @property double $investor_amount
 * @property string $create_date
 * @property string $update_date
 * @property string $is_blocked
 * @property string $count_view
 * @property string $count_click
 * @property array $daysShow
 * @property array $usersShow
 *
 * The followings are the available model relations:
 * @property Media $media
 * @property Region $region
 * @property User $user
 * @property Banner2Country[] $banner2Countries
 * @property Banner2Industry[] $banner2Industries
 * @property Banner2InvestorType[] $banner2InvestorTypes
 * @property Banner2Region[] $banner2Regions
 */
class Banner extends ActiveRecord
{
    static $setAttributes = array('user_show', 'day_show');
    const T_CLICK = 'click';
    const T_VIEW = 'view';

    const VIEW_MIN_PRICE = 1000;

    public function tableName()
    {
        return 'Banner';
    }

    public function rules()
    {
        return array(
            array('user_id, media_id, status, url, price, type, create_date, update_date,user_show,day_show', 'required'),
            array('balance, investor_amount', 'numerical'),
            array('user_id, media_id, status, region_id, price, count_view, count_click', 'length', 'max' => 10),
            array('type', 'length', 'max' => 5),
            array('url', 'url'),
            array('is_blocked', 'length', 'max' => 3),
            array('user_show, day_show,usersShow,daysShow', 'safe'),
            array('balance', 'unsafe'),
            array('id, user_id, media_id, status, url, region_id, price, balance, type, user_show, day_show, investor_amount, create_date, update_date, is_blocked, count_view, count_click', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'media' => array(self::BELONGS_TO, 'Media', 'media_id'),
            'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'banner2Countries' => array(self::HAS_MANY, 'Banner2Country', 'banner_id'),
                'banner2Industries' => array(self::HAS_MANY, 'Banner2Industry', 'banner_id'),
            'banner2InvestorTypes' => array(self::HAS_MANY, 'Banner2InvestorType', 'banner_id'),
            'banner2Regions' => array(self::HAS_MANY, 'Banner2Region', 'banner_id'),
            'manyCountries' => array(self::MANY_MANY, 'Country', 'Banner2Country(banner_id, country_id)'),
            'manyRegions' => array(self::MANY_MANY, 'Region', 'Banner2Region(banner_id, region_id)'),
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
            'media_id' => Yii::t('main', 'Баннер'),
            'status' => Yii::t('main', 'Статус'),
            'url' => Yii::t('main', 'Ссылка'),
            'region_id' => Yii::t('main', 'Регион'),
            'price' => Yii::t('main', 'Цена'),
            'balance' => Yii::t('main', 'Баланс'),
            'type' => Yii::t('main', 'Тип'),
            'user_show' => Yii::t('main', 'Типы пользователей, которым показывать'),
            'day_show' => Yii::t('main', 'Время отображения баннера'),
            'investor_amount' => Yii::t('main', 'Сумма финансирования (млн. руб.)'),
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_blocked' => 'Is Blocked',
            'count_view' => 'Count View',
            'count_click' => 'Count Click',
        );
    }

    public function getUsersShow()
    {
        return array_filter(explode(',', $this->user_show));
    }

    public function setUsersShow($value)
    {
        $this->user_show = implode(',', $value);
    }

    public function getDaysShow()
    {
        return array_filter(explode(',', $this->day_show));
    }

    public function setDaysShow($value)
    {
        $this->day_show = implode(',', $value);
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
        $criteria->compare('url', $this->url, true);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('balance', $this->balance);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('user_show', $this->user_show, true);
        $criteria->compare('day_show', $this->day_show, true);
        $criteria->compare('investor_amount', $this->investor_amount);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('is_blocked', $this->is_blocked, true);
        $criteria->compare('count_view', $this->count_view, true);
        $criteria->compare('count_click', $this->count_click, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
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
            'new' => Yii::t('main', 'Новый'),
            'approved' => Yii::t('main', 'Активен'),
            'rejected' => Yii::t('main', 'Возврат'),
        );
        return is_null($id) ? $array : $array[$id];
    }

    public function getStatus()
    {
        if ($this->is_blocked) {
            return Yii::t('main', 'Заблокирован');
        }
        return $this->statusList($this->status);
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
     * Выдать случный (по цене) набор баннеров
     * @param $regionId
     * @return Banner[]
     */
    public static function findActiveBanner($regionId)
    {
        $result = array();
        define('BANNER_COUNT', 4); #максимальное количество баннеров
        $count = 0;
        $criteria = new CDbCriteria();
        $criteria->with = array('banner2Regions');
        $criteria->addCondition('t.is_blocked = 0 AND t.status = "approved" AND FIND_IN_SET(:day,day_show)>0');
        $criteria->params += array(':day' => Candy::getWeekDay());
        if (Yii::app()->user->isGuest) {
            $criteria->addCondition('banner2Regions.region_id = :region_id');
            $criteria->params += array(":region_id" => Yii::app()->getController()->currentRegion);
        } else {
            $regionList = array();
            $regionList[Yii::app()->getController()->currentRegion] = Yii::app()->getController()->currentRegion;
            $regionList[Yii::app()->getController()->user->region_id] = Yii::app()->getController()->user->region_id;
            foreach (Yii::app()->getController()->user->user2Regions as $item) {
                $regionList[$item->region_id] = $item->region_id;
            }
            $criteria->addInCondition('banner2Regions.region_id', $regionList);
        }
        $criteria->addCondition('(t.balance >= t.price AND t.type = "click")
            || (t.type = "view" AND ((t.count_view % 1000 = 0 && t.balance >= t.price) || (t.count_view % 1000 !=0)) )');
        $criteria->order = 't.price DESC';
        $criteria->index = 'id';

        $banners = self::model()->findAll($criteria);

        if (count($banners) <= BANNER_COUNT) { #дальше не нужно высчитывать
            $result = $banners;
        } else {
            $weights = array();
            foreach ($banners as $banner) {
                $params = array(
                    'banner2region' => CHtml::listData($banner->banner2Regions, 'id', 'region_id'),
                    'Banner' => array(
                        'usersShow' => $banner->usersShow,
                        'investor_amount' => $banner->investor_amount,
                    )
                );
                if (in_array(User::T_INVESTOR, $banner->usersShow)) {
                    $params += array(
                        'banner2country' => CHtml::listData($banner->banner2Countries, 'id', 'country_id'),
                        'banner2industry' => CHtml::listData($banner->banner2Industries, 'id', 'industry_id'),
                        'banner2investorType' => CHtml::listData($banner->banner2InvestorTypes, 'id', 'type_id'),
                    );
                }
                $countTarget = User::countTarget($params);
                $weights[$banner->id] = $banner->price / ($countTarget); //не умножаем на 0.1, потому как рендом от мелких не находит
            }
            foreach ($banners as $key => $banner) {
                $count++;
                $element = Candy::rand_by_weight($banners, $weights);

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
            $this->pay($this->price);
        }
        $this->count_view += 1;
        $this->save();
    }

    public function addClick()
    {
        if($this->type=='click'){
            $this->pay($this->price);
        }
        $this->count_click += 1;
        $this->save();
    }

    public function pay($price)
    {
        $this->balance -= $price;
        if ($this->balance < 0) {
            $this->balance = 0;
        }
        $this->save();
    }

    /**
     * При создании получить рекомендацию
     * @param $relation
     * @param $model
     * @param $key
     */
    public function recommendInvestorAmount()
    {
        if (empty($this->investor_amount)) {
            $this->investor_amount = Yii::app()->getController()->user->investor_finance_amount;
        }
        return $this->investor_amount;
    }

    public function beforeValidate()
    {
        if ($this->price == 0) {
            $this->addError('price', Yii::t('main', 'Цена не может быть равна нулю'));
        } else {
            if ($this->type == self::T_CLICK) {
                $min = Setting::get(Setting::START_PRICE_CLICK);
                if ($this->price <= $min)
                    $this->addError('price', Yii::t('main', "Цена за один клик должна быть более чем $min рублей"));
            } else {
                $min = Setting::get(Setting::START_PRICE_VIEW);
                if ($this->price <= $min)
                    $this->addError('price', Yii::t('main', "Цена за 1000 просмотров должна быть более чем $min рублей"));
            }
        }
        if (count($this->usersShow) == 0) {
            $this->addError('usersShow', Yii::t('main', 'Должен быть выбран, хотя бы один тип'));
        }
        if (count($this->daysShow) == 0) {
            $this->addError('daysShow', Yii::t('main', 'Должен быть выбран, хотя бы один день'));
        }
        if($this->scenario!='click_and_view' && $this->isNew()){
            $minBalance = Setting::get(Setting::MIN_BANNER_BALANCE);
            if($this->balance < $minBalance){
                $this->addError('balance', Yii::t('main', "Баланс баннера должен быть более $minBalance"));
            }
        }
        return parent::beforeValidate();
    }

    public function approve()
    {
        $this->status = 'approved';
        $this->save();
    }

    public function reject($test = '')
    {
        $this->status = 'rejected';
        $this->save();
    }

    public function moderate()
    {
        $this->status = 'moderation';
        $this->save();
    }

    public function addBalance($sum, User $user,$hasNullable = false)
    {
        if($hasNullable){
            $this->balance = 0;
        }
        $balance = Balance::get($user->id);
        if ($balance->pay($user->id, $sum, 'banner')) {
            $this->balance += $sum;
            $this->save();
            return true;
        }
        return false;
    }

    public function isNew(){
        return empty($this->status) || $this->status == 'new';
    }
}
