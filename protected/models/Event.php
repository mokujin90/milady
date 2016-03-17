<?php

/**
 * This is the model class for table "Event".
 *
 * The followings are the available columns in table 'Event':
 * @property string $id
 * @property string $name
 * @property string $latin_name
 * @property string $announce
 * @property string $full_text
 * @property string $create_date
 * @property string $media_id
 * @property integer $is_active
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $contact_www
 * @property string $contact_person
 * @property string $datetime
 * @property string $contact_place
 *
 * The followings are the available model relations:
 * @property Media $media
 */
class Event extends ActiveRecord
{
    public $time = null;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, full_text,datetime', 'required'),
            array('is_active', 'numerical', 'integerOnly'=>true),
            array('name, latin_name', 'length', 'max'=>255, 'tooLong' => "Поле  «{attribute}» слишком длинное."),
            array('media_id', 'length', 'max'=>10),
            array('announce, create_date, contacts, lat, lon, tags, source, author,contact_phone,contact_email,contact_www,contact_person,datetime,contact_place,time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, latin_name, announce, full_text, create_date, media_id, is_active', 'safe', 'on'=>'search'),
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
            'sliders' => array(self::HAS_MANY, 'Event2Media', 'event_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'latin_name' => 'Latin Name',
            'announce' => 'Анонс',
            'full_text' => 'Текст мероприятия',
            'create_date' => 'Дата создания',
            'media_id' => 'Медиа',
            'is_active' => 'Активное событие',
            'contacts' => 'Контакты',
            'tags' => 'Теги',
            'source' => 'Источник',
            'author' => 'Автор',
            'contact_phone' => Yii::t('main','Телефон'),
            'contact_email' => Yii::t('main','E-mail'),
            'contact_www' => 'Www',
            'contact_person' => Yii::t('main','Контактное лицо'),
            'datetime' => Yii::t('main','Дата события'),
            'contact_place' => Yii::t('main','Место'),

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
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('media_id',$this->media_id,true);
        $criteria->compare('is_active',$this->is_active);

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
     * @return Event the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function beforeValidate()
    {
        $this->create_date = empty($this->create_date) ? Candy::currentDate(Candy::DATE) : $this->create_date;
        if(!empty($this->time) && count(explode(':',$this->time))==2){

            $times = explode(':',$this->time);

            if($times[0]>23 || $times[1]>59){
                $this->addError('time',Yii::t('main','Неверный формат времени'));
            }
            else{
                $this->datetime = $this->datetime." ".$this->time.":00";
            }
        }
        return parent::beforeValidate();
    }

    public function createUrl(){
        $controller = Yii::app()->controller;
        return $controller->createUrl('event/detail', array('id' => $this->id));
    }
}