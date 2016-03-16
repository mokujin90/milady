<?php

/**
 * This is the model class for table "News2Media".
 *
 * The followings are the available columns in table 'News2Media':
 * @property string $id
 * @property string $media_id
 * @property string $news_id
 * @property string $notice
 * @property string $source_url
 * @property string $normal_name
 *
 * The followings are the available model relations:
 * @property Media $media
 * @property News $news
 */
class News2Media extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'News2Media';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('media_id, news_id', 'required'),
			array('media_id, news_id', 'length', 'max'=>10),
			array('notice, source_url,normal_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, media_id, news_id, notice, source_url', 'safe', 'on'=>'search'),
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
			'news' => array(self::BELONGS_TO, 'News', 'news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'media_id' => 'Media',
			'news_id' => 'News',
			'notice' => 'Notice',
			'source_url' => 'Source Url',
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
		$criteria->compare('news_id',$this->news_id,true);
		$criteria->compare('notice',$this->notice,true);
		$criteria->compare('source_url',$this->source_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News2Media the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
