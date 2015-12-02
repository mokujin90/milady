<?php

/**
 * This is the model class for table "Admin".
 *
 * The followings are the available columns in table 'Admin':
 * @property string $id
 * @property string $login
 * @property string $password
 * @property integer $superadmin
 *
 * The followings are the available model relations:
 * @property Admin2Right[] $admin2Rights
 */
class AdminUser extends CActiveRecord
{
	public $adminRightsField = false;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login', 'unique'),
			array('login, password', 'required'),
			array('superadmin', 'unsafe'),
			array('login, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password', 'safe', 'on'=>'search'),
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
			'admin2Rights' => array(self::HAS_MANY, 'Admin2Right', 'admin_id'),
			'admin2Widgets' => array(self::HAS_MANY, 'Admin2Widget', 'admin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Логин',
			'password' => 'Пароль',
			'superadmin' => 'Superadmin',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->addColumnCondition(array('superadmin'=>0));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterSave()
	{
		parent::afterSave();
		if (is_array($this->adminRightsField)) {
			Admin2Right::model()->deleteAllByAttributes(array('admin_id' => $this->id));
			foreach ($this->adminRightsField as $right => $val) {
				if (!empty($val)) {
					$item = new Admin2Right();
					$item->admin_id = $this->id;
					$item->right = $right;
					$item->save();
				}
			}
		}
	}

	public function can($right)
	{
		if($right == 'index'){
			return true;
		}
		if ($this->superadmin) {
			return true;
		}
		foreach ($this->admin2Rights as $item) {
			if ($item->right == $right) {
				return true;
			}
		}
		return false;
	}

	public function canWidget($widget)
	{

		if ($this->superadmin) {
			return true;
		}
		foreach ($this->admin2Rights as $item) {
			if ($item->right == Admin2Widget::$widgets[$widget]['right']) {
				return true;
			}
		}
		return false;
	}
}
