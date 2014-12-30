<?php

/**
 * This is the model class for table "BalanceHistory".
 *
 * The followings are the available columns in table 'BalanceHistory':
 * @property string $id
 * @property string $user_id
 * @property string $balance_in
 * @property string $balance_out
 * @property integer $delta
 * @property string $description
 * @property string $create_date
 * @property string $object_type
 *
 * The followings are the available model relations:
 * @property User $user
 */
class BalanceHistory extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'BalanceHistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, balance_in, balance_out, delta, create_date, object_type', 'required'),
			array('delta', 'numerical', 'integerOnly'=>true),
			array('user_id, balance_in, balance_out', 'length', 'max'=>10),
			array('object_type', 'length', 'max'=>12),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, balance_in, balance_out, delta, description, create_date, object_type', 'safe', 'on'=>'search'),
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
			'balance_in' => 'Balance In',
			'balance_out' => 'Balance Out',
			'delta' => 'Delta',
			'description' => 'Description',
			'create_date' => 'Create Date',
			'object_type' => 'Object Type',
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
		$criteria->compare('balance_in',$this->balance_in,true);
		$criteria->compare('balance_out',$this->balance_out,true);
		$criteria->compare('delta',$this->delta);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('object_type',$this->object_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BalanceHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function findAllByUser($userId){
        return Yii::app()->db->createCommand()
            ->select('object_type, id, create_date as date, description, delta')
            ->from("BalanceHistory as main")
            ->where('user_id = :user_id AND (object_type != "view_banner" AND object_type != "click_banner")',
                array(':user_id' => $userId))
            /*->union(
                Yii::app()->db->createCommand()
                    ->select('object_type, id, DATE_FORMAT(create_date, "%Y-%m") as date, description, SUM(delta)')
                    ->from("BalanceHistory as second")
                    ->where('user_id = :user_id AND (object_type = "view_banner" OR object_type = "click_banner")',
                        array(':user_id' => $userId))
                    ->group('date')
                    ->getText()
            )*/
            ->order('date')
            ->queryAll();
    }

    public static function getType($type){
        switch ($type){
            case 'add':
                return Yii::t('main','Пополнение');
            case "retention":
                return Yii::t('main','Зарезервировано');
            case "sub":
                return Yii::t('main','Списание');
            case "banner":
                return Yii::t('main','Перевод на баланс баннера');
        }
    }
}
