<?php

/**
 * This is the model class for table "StaticBanner".
 *
 * The followings are the available columns in table 'StaticBanner':
 * @property string $id
 * @property string $place_id
 * @property string $media_id
 * @property integer $height
 * @property integer $width
 * @property string $url
 *
 * The followings are the available model relations:
 * @property Media $media
 */
class StaticBanner extends CActiveRecord
{
    const MAIN_PAGE_LONG = 1;
    const MAIN_PAGE_NEWS = 2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'StaticBanner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('place_id', 'required'),
			array('height, width', 'numerical', 'integerOnly'=>true),
			array('place_id', 'length', 'max'=>5),
			array('media_id', 'length', 'max'=>10),
			array('url', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, place_id, media_id, height, width, url', 'safe', 'on'=>'search'),
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
			'place_id' => Yii::t('main','Место'),
			'media_id' => 'Media',
			'height' => Yii::t('main','Высота'),
			'width' => Yii::t('main','Ширина'),
			'url' => 'Url',
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
		$criteria->compare('place_id',$this->place_id,true);
		$criteria->compare('media_id',$this->media_id,true);
		$criteria->compare('height',$this->height);
		$criteria->compare('width',$this->width);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StaticBanner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function draw($place_id){
        $html = '';
        $model = self::model()->findByAttributes(array('place_id'=>$place_id));
        if($model && $model->media){
            $html .= CHtml::link(Candy::preview(array($model->media,'scale'=>$model->getSize())),$model->url,array('class'=>'banner'));
        }
        return $html;
    }

    public static function getPlace($placeId){
        $array = array(
            self::MAIN_PAGE_LONG => Yii::t('main','Длинный баннер на главной странице'),
            self::MAIN_PAGE_NEWS => Yii::t('main','Баннер на главной в разделе новостей'),
        );
        return $array[$placeId];
    }

    public function getSize(){
        return "{$this->width}x{$this->height}";
    }
}
