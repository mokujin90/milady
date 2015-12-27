<?php

/**
 * This is the model class for table "UserView".
 *
 * The followings are the available columns in table 'UserView':
 * @property string $id
 * @property string $viewer_id
 * @property string $target_user_id
 * @property string $view_type
 *
 * The followings are the available model relations:
 * @property User $targetUser
 * @property User $viewer
 */
class UserView extends CActiveRecord
{
	public static function addView($type, $viewer_id, $target_user_id)
	{
		if($viewer_id == $target_user_id) return;

		UserView::model()->deleteAllByAttributes(array('view_type' => $type, 'viewer_id' => $viewer_id, 'target_user_id' => $target_user_id));

		$model = new UserView();
		$model->view_type = $type;
		$model->viewer_id = $viewer_id;
		$model->target_user_id = $target_user_id;
		$model->save();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'UserView';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('viewer_id, target_user_id', 'required'),
			array('viewer_id, target_user_id', 'length', 'max'=>10),
			array('view_type', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, viewer_id, target_user_id, view_type', 'safe', 'on'=>'search'),
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
			'targetUser' => array(self::BELONGS_TO, 'User', 'target_user_id'),
			'viewer' => array(self::BELONGS_TO, 'User', 'viewer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'viewer_id' => 'Viewer',
			'target_user_id' => 'Target User',
			'view_type' => 'View Type',
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
		$criteria->compare('viewer_id',$this->viewer_id,true);
		$criteria->compare('target_user_id',$this->target_user_id,true);
		$criteria->compare('view_type',$this->view_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
