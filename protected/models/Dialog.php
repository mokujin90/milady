<?php

/**
 * This is the model class for table "Dialog".
 *
 * The followings are the available columns in table 'Dialog':
 * @property string $id
 * @property string $subject
 * @property string $create_date
 * @property string $update_date
 *
 * The followings are the available model relations:
 * @property Message[] $messages
 * @property User2Dialog[] $user2Dialogs
 */
class Dialog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Dialog';
	}

	protected function beforeSave()
	{
		$date = date('Y-m-d H:i:s');
		if($this->isNewRecord){
			$this->create_date = $date;

		}
		$this->update_date = $date;
		return parent::beforeSave();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject', 'length', 'max'=>255),
			array('create_date, update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subject, create_date, update_date', 'safe', 'on'=>'search'),
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
			'messages' => array(self::HAS_MANY, 'Message', 'dialog_id'),
			'deal' => array(self::HAS_ONE, 'Deal', 'dialog_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'user2Dialogs' => array(self::HAS_MANY, 'User2Dialog', 'dialog_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dialog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getLastMessage(){
		return Message::model()->find(array('condition' => 'dialog_id = :dialog','params' => array('dialog' => $this->id), 'order' => 'create_date DESC'));
	}

	public function getUserTo($getFirst = false){
		$user2Dialog = User2Dialog::model()->findAllByAttributes(array('dialog_id' => $this->id));
		foreach($user2Dialog as $item){
			if($getFirst) {
				return $item->user_id;
			}
			if($item->user_id != Yii::app()->user->id) return $item->user_id;
		}
		return null;
	}
	public function getUserToModel($getFirst = false){
		$user2Dialog = User2Dialog::model()->findAllByAttributes(array('dialog_id' => $this->id));
		foreach($user2Dialog as $item){
			if($getFirst) {
				return $item->user;
			}
			if($item->user_id != Yii::app()->user->id) return $item->user;
		}
		return null;
	}

	public function getDialForm(){
		if ($this->deal) {
			if($this->deal->sender_id == Yii::app()->user->id){
				return null;
			}
			return Deal::$form[$this->deal->status];
		}
		return Deal::$form['pending'];
	}
	public function getDialStatus(){
		if ($this->deal) {
			return $this->deal->status;
		}
		return 'pending';
	}
}
