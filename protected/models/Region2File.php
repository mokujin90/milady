<?php

/**
 * This is the model class for table "Region2File".
 *
 * The followings are the available columns in table 'Region2File':
 * @property string $id
 * @property string $media_id
 * @property string $region_id
 * @property string $title
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Media $media
 * @property Region $region
 */
class Region2File extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Region2File';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('media_id', 'required'),
			array('media_id, region_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>255, 'tooLong' => "Поле  «{attribute}» слишком длинное."),
			array('title', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, media_id, region_id, title, name', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('main','ID'),
			'media_id' => Yii::t('main','Media'),
			'region_id' => Yii::t('main','Region'),
			'title' => Yii::t('main','Title'),
			'name' => Yii::t('main','Name'),
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
		$criteria->compare('media_id',$this->media_id,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Region2File the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
