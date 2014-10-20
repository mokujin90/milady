<?php

/**
 * This is the model class for table "InfrastructureProject".
 *
 * The followings are the available columns in table 'InfrastructureProject':
 * @property string $id
 * @property string $project_id
 * @property string $name
 * @property string $latin_name
 * @property string $short_description
 * @property double $investment_sum
 * @property string $effect
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class InfrastructureProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'InfrastructureProject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('investment_sum', 'numerical'),
			array('project_id', 'length', 'max'=>10),
			array('name, latin_name, short_description, effect', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, name, latin_name, short_description, investment_sum, effect', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'name' => 'Name',
			'latin_name' => 'Latin Name',
			'short_description' => 'Short Description',
			'investment_sum' => 'Сумма инвестиций, млн. руб.',
			'effect' => 'Социально­экономический эффект от реализации',
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
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('latin_name',$this->latin_name,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('investment_sum',$this->investment_sum);
		$criteria->compare('effect',$this->effect,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfrastructureProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
