<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $fio
 * @property string $login
 * @property string $pass
 * @property string $email
 * @property string $company
 * @property string $phone
 * @property string $fax
 * @property integer $subscribe
 * @property string $group
 */
class ImportUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fio, login, pass, email, company, phone, fax, subscribe', 'required'),
			array('subscribe', 'numerical', 'integerOnly'=>true),
			array('group', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fio, login, pass, email, company, phone, fax, subscribe, group', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fio' => 'Fio',
			'login' => 'Login',
			'pass' => 'Pass',
			'email' => 'Email',
			'company' => 'Company',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'subscribe' => 'Subscribe',
			'group' => 'Group',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('subscribe',$this->subscribe);
		$criteria->compare('group',$this->group,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db2;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImportUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
