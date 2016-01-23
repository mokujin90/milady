<?php

/**
 * This is the model class for table "Tender".
 *
 * The followings are the available columns in table 'Tender':
 * @property string $id
 * @property string $name
 * @property string $latin_name
 * @property string $number
 * @property string $source
 * @property string $full_text
 * @property string $tags
 * @property string $create_date
 * @property string $media_id
 * @property string $region_id
 * @property string $type
 * @property string $date
 * @property string $file_id
 * @property string $file_title
 *
 * The followings are the available model relations:
 * @property Region $region
 * @property Media $media
 * @property Media $file
 */
class Tender extends CActiveRecord
{
	public static function getType()
	{
		return array(
			0 => Yii::t('main', 'Премии, гранты'),
			1 => Yii::t('main', 'Госконтракты'),
			2 => Yii::t('main', 'Конкурс ФЦП'),
			3 => Yii::t('main', 'Наноолимпиады'),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Tender';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_text, type, name, date', 'required'),
			array('name, latin_name, number, file_title', 'length', 'max'=>255),
			array('media_id, type, file_id, region_id', 'length', 'max'=>10),
			array('source, tags, create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, latin_name, number, source, full_text, tags, create_date, media_id, region_id, type, date, file_id, file_title', 'safe', 'on'=>'search'),
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
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
			'media' => array(self::BELONGS_TO, 'Media', 'media_id'),
			'file' => array(self::BELONGS_TO, 'Media', 'file_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('main','Заголовок'),
			'latin_name' => 'Latin Name',
			'number' => Yii::t('main','Номер'),
			'source' => Yii::t('main','Источник'),
			'full_text' => Yii::t('main','Текст'),
			'tags' => Yii::t('main','Теги'),
			'create_date' => Yii::t('main','Дата создания'),
			'media_id' =>  Yii::t('main','фото'),
			'region_id' =>  Yii::t('main','Регион'),
			'type' => Yii::t('main','Категория'),
			'date' => Yii::t('main','Дата'),
			'file_id' => Yii::t('main','Файл'),
			'file_title' => Yii::t('main','Название файла'),
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('full_text',$this->full_text,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('media_id',$this->media_id,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('file_id',$this->file_id,true);
		$criteria->compare('file_title',$this->file_title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tender the static model class
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
}
