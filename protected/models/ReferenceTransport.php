<?php

/**
 * This is the model class for table "ReferenceTransport".
 *
 * The followings are the available columns in table 'ReferenceTransport':
 * @property string $id
 * @property string $type
 * @property string $name
 * @property string $url
 *
 * The followings are the available model relations:
 * @property Region2Transport[] $region2Transports
 */
class ReferenceTransport extends CActiveRecord
{
	public static $types = array(
		'air' => 'Аэропорт',
		'port' => 'Порт',
		'railway' => 'ЖД Вокзал',
	);

	public static function getList($type)
	{
		$typeArr = array(
			'RegionPort' => 'port',
			'RegionAirport' => 'air',
			'RegionStation' => 'railway',
		);
		return ReferenceTransport::model()->findAllByAttributes(array('type' => $typeArr[$type]));
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ReferenceTransport';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('type', 'length', 'max'=>7),
			array('name, url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, name, url', 'safe', 'on'=>'search'),
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
			'region2Transports' => array(self::HAS_MANY, 'Region2Transport', 'transport_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'name' => 'Name',
			'url' => 'Url',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReferenceTransport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
