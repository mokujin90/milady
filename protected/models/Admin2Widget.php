
<?php

/**
 * This is the model class for table "Admin2Widget".
 *
 * The followings are the available columns in table 'Admin2Widget':
 * @property string $id
 * @property string $admin_id
 * @property string $disabled_widget
 *
 * The followings are the available model relations:
 * @property AdminUser $admin
 */
class Admin2Widget extends CActiveRecord
{

	public static $widgets = array(
		'news' => array(
			'right' => 'content',
			'name' => 'Новости',
			'model' => 'News',
			'icon' => 'file-text-o'
		),
		'analytics' => array(
			'right' => 'content',
			'name' => 'Аналитика',
			'model' => 'Analytics',
			'icon' => 'area-chart',
		),
		'events' => array(
			'right' => 'content',
			'name' => 'События',
			'model' => 'Event',
			'icon' => 'file-text-o'
		),
		'project' => array(
			'right' => 'project',
			'name' => 'Проекты',
			'model' => 'Project',
			'icon' => 'file-text-o'
		),
		'project-comment' => array(
			'right' => 'project',
			'name' => 'Комментарии к проектам',
			'model' => 'Comment',
			'icon' => 'comment',
			'condition' => 'type = "project"'
		),
		'news-comment' => array(
			'right' => 'content',
			'name' => 'Комментарии к новостям',
			'model' => 'Comment',
			'icon' => 'comment',
			'condition' => 'type = "news"'
		),
		'analytics-comment' => array(
			'right' => 'content',
			'name' => 'Комментарии к статьям',
			'model' => 'Comment',
			'icon' => 'comment',
			'condition' => 'type = "analytics"'
		),
		'adv' => array(
			'right' => 'adv',
			'name' => 'Реклама',
			'model' => 'Banner',
			'icon' => 'star',
		),
	);
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Admin2Widget';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_id', 'required'),
			array('admin_id', 'length', 'max'=>10),
			array('disabled_widget', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, admin_id, disabled_widget', 'safe', 'on'=>'search'),
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
			'admin' => array(self::BELONGS_TO, 'AdminUser', 'admin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'admin_id' => 'Admin',
			'disabled_widget' => 'Disabled Widget',
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
		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('disabled_widget',$this->disabled_widget,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin2Widget the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}