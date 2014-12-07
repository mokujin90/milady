<?php

/**
 * This is the model class for table "Region".
 *
 * The followings are the available columns in table 'Region':
 * @property string $id
 * @property string $name
 * @property string $lat
 * @property string $lon
 * @property string $latin_name
 * @property integer $district_id
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 * @property User[] $users
 * @property RegionContent[] $content
 */
class Region extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Region';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('district_id', 'required'),
            array('district_id', 'numerical', 'integerOnly'=>true),
            array('name, latin_name', 'length', 'max'=>255),
            array('lat, lon', 'length', 'max'=>50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, latin_name, district_id, lat, lon', 'safe', 'on'=>'search'),
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
			'projects' => array(self::HAS_MANY, 'Project', 'region_id'),
			'users' => array(self::HAS_MANY, 'User', 'region_id'),
            'content' => array(self::HAS_ONE, 'RegionContent', 'region_id'),
            'district' => array(self::BELONGS_TO, 'District', 'district_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя',
			'latin_name' => 'Latin Name',
			'district_id' => 'District',
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
		$criteria->compare('district_id',$this->district_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Region the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Вернуть все города для dropDown листа
     */
    static function getDrop(){
        return CHtml::listData(self::model()->findAll(),'id','name');
    }

    /**
     * Сформировать статистику по отраслям в этих регионах
     */
    public static function getStatisticByIndustry(){
        $sql = Yii::app()->db->createCommand();
    }

}
