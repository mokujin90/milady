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
 * @property string $user_show
 * @property string $create_date
 * @property string $update_date
 * @property string $is_blocked
 * @property array $daysShow
 * @property array $usersShow
 *
 * The followings are the available model relations:
 * @property Media $media
 * @property Region $region
 * @property User $user
 * @property FeedBanner2Region[] $banner2Regions
 * @property FeedBanner2Region[] $banner2Date
 */
class FeedBanner extends ActiveRecord
{
    public $bannerPublishDates = false;
    static $setAttributes = array('user_show', 'day_show');

    public function tableName()
    {
        return 'FeedBanner';
    }

    public function rules()
    {
        return array(
            array('user_id, media_id, status, url, content, create_date, update_date, user_show', 'required'),
            array('user_id, media_id, status, region_id', 'length', 'max' => 10),
            array('url', 'url'),
            array('is_blocked', 'length', 'max' => 3),
            array('user_show,usersShow', 'safe'),
            array('status', 'unsafe'),
            array('id, user_id, media_id, status, url, region_id, user_show, create_date, update_date, is_blocked', 'safe', 'on' => 'search'),
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
            'banner2Regions' => array(self::HAS_MANY, 'FeedBanner2Region', 'banner_id'),
            'banner2Date' => array(self::HAS_MANY, 'FeedBanner2Date', 'banner_id'),
            'manyRegions' => array(self::MANY_MANY, 'Region', 'FeedBanner2Region(banner_id, region_id)'),
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
            'content' => Yii::t('main', 'Текст объявления'),
            'region_id' => Yii::t('main', 'Регион'),
            'user_show' => Yii::t('main', 'Типы пользователей, которым показывать'),
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_blocked' => 'Is Blocked',
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
        $criteria->compare('user_show', $this->user_show, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('is_blocked', $this->is_blocked, true);

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

    public function beforeValidate()
    {
        if (count($this->usersShow) == 0) {
            $this->addError('usersShow', Yii::t('main', 'Должен быть выбран, хотя бы один тип'));
        }
        return parent::beforeValidate();
    }

    public function afterSave(){
        parent::afterSave();
        if(is_array($this->bannerPublishDates)){
            FeedBanner2Date::model()->deleteAllByAttributes(array('banner_id' => $this->id));
            $maxCount = 5;
            foreach($this->bannerPublishDates as $item){
                $date = new FeedBanner2Date();
                $date->banner_id = $this->id;
                $date->publish_date = $item['publish_date'];
                if($date->save()){
                    $maxCount--;
                    if($maxCount == 0){
                         break;
                    }
                }
            }
        }
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

    public function isNew(){
        return empty($this->status) || $this->status == 'new';
    }

    public function pay(User $user)
    {
        $balance = Balance::get($user->id);
        if ($balance->pay($user->id, Setting::get(Setting::FEED_BANNER_PRICE), 'feedBanner')) {
            if(!$this->save()){
                $balance->pay($user->id, Setting::get(Setting::FEED_BANNER_PRICE), Balance::T_ADD);
            }
            return true;
        }
        return false;
    }

    public function createUrl()
    {
        $controller = Yii::app()->controller;
        return $controller->createUrl('banner/away', array('bannerId' => $this->id));
    }

    public function createEditUrl()
    {
        $controller = Yii::app()->controller;
        return $controller->createUrl('banner/feedEdit', array('id' => $this->id));
    }

    public function addView()
    {
        if(!$model = FeedBannerStat::model()->findByAttributes(array('banner_id' => $this->id, 'date' => date('Y-m-d')))){
            $model = new FeedBannerStat();
            $model->banner_id = $this->id;
            $model->date = date('Y-m-d');
            $model->view = 1;
        } else {
            $model->view += 1;
        }
        $model->save();
    }

    public function addClick()
    {
        if(!$model = FeedBannerStat::model()->findByAttributes(array('banner_id' => $this->id, 'date' => date('Y-m-d')))){
            $model = new FeedBannerStat();
            $model->banner_id = $this->id;
            $model->date = date('Y-m-d');
            $model->click = 1;
        } else {
            $model->click += 1;
        }
        $model->save();
    }
}
