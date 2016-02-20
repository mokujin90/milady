<?php

/**
 * This is the model class for table "News".
 *
 * The followings are the available columns in table 'News':
 * @property string $id
 * @property string $name
 * @property string $latin_name
 * @property string $announce
 * @property string $full_text
 * @property string $tags
 * @property string $create_date
 * @property string $media_id
 * @property integer $on_main
 * @property integer $is_main
 * @property string $region_id
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property Media $media
 * @property Region $region
 */
class News extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'News';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, full_text', 'required'),
            array(
                'source_url',
                'match', 'pattern' => '/^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})$/',
                'message' => 'Ссылка на источник не является правильным URL',
            ),
            array('is_main, on_main, is_active', 'numerical', 'integerOnly'=>true),
            array('image_notice, source_url, name, latin_name', 'length', 'max'=>255),
            array('media_id, region_id', 'length', 'max'=>10),
            array('announce, tags, create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, image_notice, source_url, name, latin_name, announce, full_text, tags, create_date, media_id, on_main, is_main, region_id, is_active', 'safe', 'on'=>'search'),
        );
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => Yii::t('main','Заголовок новости'),
            'latin_name' => 'Latin Name',
            'announce' => Yii::t('main','Анонс'),
            'full_text' => Yii::t('main','Текст'),
            'tags' => Yii::t('main','Теги'),
            'create_date' => Yii::t('main','Дата размещения'),
            'media_id' => 'Media',
            'on_main' => Yii::t('main','На главной'),
            'is_main' => Yii::t('main','Большой блок'),
            'region_id' => Yii::t('main','Регион'),
            'is_active' => Yii::t('main','Активность'),
            'image_notice' => Yii::t('main','Подпись к картинке'),
            'source_url' => Yii::t('main','Ссылка на источник'),
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

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('latin_name',$this->latin_name,true);
        $criteria->compare('announce',$this->announce,true);
        $criteria->compare('full_text',$this->full_text,true);
        $criteria->compare('tags',$this->tags,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('media_id',$this->media_id,true);
        $criteria->compare('on_main',$this->on_main);
        $criteria->compare('is_main',$this->is_main);
        $criteria->compare('region_id',$this->region_id,true);
        $criteria->compare('is_active',$this->is_active);
        $criteria->compare('image_notice',$this->image_notice);
        $criteria->compare('source_url',$this->source_url);

        if(isset($_GET['day']) && isset($_GET['dayType'])){
            $criteria->addCondition('DATE(create_date) ' . ($_GET['dayType'] == 'equals'? '=' : '>=') . ':day');
            $criteria->params += array('day' => $_GET['day']);
        }
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
     * @return News the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function beforeValidate()
    {
        $this->region_id = empty($this->region_id) ? null : $this->region_id;
        $this->create_date = empty($this->create_date) ? Candy::currentDate(Candy::DATE) : $this->create_date;
        return parent::beforeValidate();
    }

    public function createUrl(){
        $controller = Yii::app()->controller;
        return $controller->createUrl('news/detail', array('id' => $this->id));
    }

    public function isFavorite()
    {
        return Favorite::model()->count('user_id =:user AND news_id =:news', array('user' => Yii::app()->user->id, 'news'=> $this->id));
    }
}