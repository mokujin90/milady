<?php

/**
 * This is the model class for table "InvestmentSite2Infrastructure".
 *
 * The followings are the available columns in table 'InvestmentSite2Infrastructure':
 * @property string $id
 * @property string $site_id
 * @property string $isset
 * @property string $power
 * @property string $distance
 * @property string $name
 * @property string $can_incrase
 *
 * The followings are the available model relations:
 * @property InvestmentSite $site
 */
class InvestmentSite2Infrastructure extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'InvestmentSite2Infrastructure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_id,name', 'required'),
			array('site_id', 'length', 'max'=>10),
			array('isset, power, distance', 'length', 'max'=>50),
			array('can_incrase', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, site_id, isset, power, distance, can_incrase', 'safe', 'on'=>'search'),
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
			'site' => array(self::BELONGS_TO, 'InvestmentSite', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main','ID'),
			'site_id' => Yii::t('main','Site'),
            'name' => Yii::t('main','Наименование'),
			'isset' => Yii::t('main','Наличие (да/нет)'),
			'power' => Yii::t('main','Мощности'),
			'distance' => Yii::t('main','Если "нет", то на каком расстоянии'),
			'can_incrase' => Yii::t('main','Возможности увеличения мощности'),
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
		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('isset',$this->isset,true);
		$criteria->compare('power',$this->power,true);
		$criteria->compare('distance',$this->distance,true);
		$criteria->compare('can_incrase',$this->can_incrase,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestmentSite2Infrastructure the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getHeader(){
        $labels = self::model()->attributeLabels();
        unset($labels['id'],  $labels['site_id']);
        return $labels;
    }
}
