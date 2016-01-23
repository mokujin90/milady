<?php

/**
 * This is the model class for table "Direct".
 *
 * The followings are the available columns in table 'Direct':
 * @property string $id
 * @property string $ip
 * @property string $region_id
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Region $region
 */
class Direct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Direct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, region_id, date', 'required'),
			array('ip', 'length', 'max'=>255),
			array('region_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ip, region_id, date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ip' => 'Ip',
			'region_id' => 'Region',
			'date' => 'Date',
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
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Direct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Записать если надо статистику о посещении гостя в регион
     * @param $regionId
     */
    public static function add($regionId){
        $criteria = new CDbCriteria();
        $criteria->addCondition('ip = :ip AND date = DATE(NOW()) AND region_id = :region_id');
        $criteria->params = array(':ip'=>Yii::app()->getRequest()->getUserHostAddress(),':region_id'=>$regionId);
        if(self::model()->count($criteria)==0){
            $model = new self();
            $model->attributes = array('region_id'=>$regionId,'date'=>Candy::currentDate('Y-m-d'),'ip'=>CHttpRequest::getUserHostAddress());
            return @$model->save();
        }
        return false;
    }

    /**
     * Удалить из базы статистику по ip, если гость в итоге авторизовался
     */
    public static function remove(){
        self::model()->deleteAllByAttributes(array('ip'=>CHttpRequest::getUserHostAddress()));
    }
}
