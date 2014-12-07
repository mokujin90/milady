<?php

/**
 * This is the model class for table "Library".
 *
 * The followings are the available columns in table 'Library':
 * @property string $id
 * @property string $media_id
 * @property string $normal_name
 * @property integer $division_id
 * @property string $create_date
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Media $media
 */
class Library extends CActiveRecord
{
    const DIVISION_INVEST = 1;
    const DIVISION_INNOVATE = 2;
    const DIVISION_INFRA = 3;

    public function getDivision()
    {
        return array(
            self::DIVISION_INVEST => array(
                'name' => Yii::t('main', 'Инвестиции')
            ),
            self::DIVISION_INNOVATE => array(
                'name' => Yii::t('main', 'Инновации')
            ),
            self::DIVISION_INFRA => array(
                'name' => Yii::t('main', 'Инфраструктура')
            ),
        );
    }

    /**
     * Получить просто имя по id (имени то в базе нет)
     * @param $id
     * @return mixed
     */
    public static function getName($id)
    {
        return self::model()->division[$id]['name'];
    }

    public static function getDrop()
    {
        $drop = array();
        foreach (self::model()->division as $id => $item) {
            $drop[$id] = $item['name'];
        }
        return $drop;
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Library';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('media_id, normal_name, division_id, title', 'required'),
			array('division_id', 'numerical', 'integerOnly'=>true),
			array('media_id', 'length', 'max'=>10),
			array('normal_name', 'length', 'max'=>255),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, media_id, normal_name, division_id, create_date, title', 'safe', 'on'=>'search'),
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
			'media' => array(self::BELONGS_TO, 'Media', 'media_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'media_id' => 'Документ',
			'normal_name' => 'Имя файла',
			'division_id' => 'Разде',
			'create_date' => 'Дата создания',
			'title' => 'Описание',
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
		$criteria->compare('media_id',$this->media_id,true);
		$criteria->compare('normal_name',$this->normal_name,true);
		$criteria->compare('division_id',$this->division_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Library the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
