<?php

/**
 * This is the model class for table "EmailLog".
 *
 * The followings are the available columns in table 'EmailLog':
 * @property string $id
 * @property string $user_id
 * @property string $email
 * @property integer $type
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property User $user
 */
class EmailLog extends CActiveRecord
{
    const T_RECOMMEND = 1;

    const MAX_EMAIL_RECOMMEND = 10;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'EmailLog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, email, type, create_date', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, email, type, create_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'email' => 'Email',
			'type' => 'Type',
			'create_date' => 'Create Date',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmailLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function isFullRecommend($userId){
        $lastEmail = Yii::app()->db->createCommand()->select('COUNT(*)')->from('EmailLog')->where('type = :recommend_type and user_id = :user_id',array(':recommend_type'=>self::T_RECOMMEND,':user_id'=>$userId))->andWhere('create_date >= now() - INTERVAL 1 DAY')->queryScalar();
        return $lastEmail>self::MAX_EMAIL_RECOMMEND;
    }
}
