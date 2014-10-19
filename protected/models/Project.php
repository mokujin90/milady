<?php

/**
 * This is the model class for table "Project".
 *
 * The followings are the available columns in table 'Project':
 * @property string $id
 * @property string $user_id
 * @property string $region_id
 * @property string $create_date
 * @property string $logo_id
 * @property string $file_id
 *
 * The followings are the available model relations:
 * @property Business[] $businesses
 * @property Infrastructure[] $infrastructureProjects
 * @property Innovative[] $innovativeProjects
 * @property Investment[] $investmentProjects
 * @property InvestmentSite[] $investmentSites
 * @property InvestmentSiteFeature[] $investmentSiteFeatures
 * @property Media $file
 * @property User $user
 * @property Region $region
 * @property Media $logo
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, region_id, logo_id, file_id', 'length', 'max'=>10),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, region_id, create_date, logo_id, file_id', 'safe', 'on'=>'search'),
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
			'businesses' => array(self::HAS_ONE, 'Business', 'project_id'),
			'infrastructure' => array(self::HAS_ONE, 'InfrastructureProject', 'project_id'),
			'innovative' => array(self::HAS_ONE, 'InnovativeProject', 'project_id'),
			'investment' => array(self::HAS_ONE, 'InvestmentProject', 'project_id'),
			'investmentSites' => array(self::HAS_ONE, 'InvestmentSite', 'project_id'),
			'investmentSiteFeatures' => array(self::HAS_MANY, 'InvestmentSiteFeature', 'project_id'),
			'file' => array(self::BELONGS_TO, 'Media', 'file_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
			'logo' => array(self::BELONGS_TO, 'Media', 'logo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'region_id' => Yii::t('main','Регион'),
			'create_date' => 'Create Date',
			'logo_id' => 'Logo',
			'file_id' => 'File',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('logo_id',$this->logo_id,true);
		$criteria->compare('file_id',$this->file_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
