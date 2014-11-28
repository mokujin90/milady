<?php

/**
 * This is the model class for table "Analytics".
 *
 * The followings are the available columns in table 'Analytics':
 * @property string $id
 * @property string $name
 * @property string $latin_name
 * @property string $announce
 * @property string $full_text
 * @property string $tags
 * @property string $create_date
 * @property string $media_id
 * @property integer $on_main
 * @property integer $is_active
 * @property string $category
 *
 * The followings are the available model relations:
 * @property Media $media
 */
class Analytics extends CActiveRecord
{

    public static function getCategoryType(){
        return array(
            'invest' => Yii::t('main', 'Инвестиции'),
            'inno' => Yii::t('main', 'Инновации'),
            'infra' => Yii::t('main', 'Инфраструктура'),
        );
    }
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Analytics';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, full_text', 'required'),
            array('on_main, is_active', 'numerical', 'integerOnly'=>true),
            array('name, latin_name', 'length', 'max'=>255),
            array('media_id', 'length', 'max'=>10),
            array('category', 'length', 'max'=>6),
            array('announce, tags, create_date', 'safe'),
            array('create_date', 'date', 'format' => 'yyyy-MM-dd'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, latin_name, announce, full_text, tags, create_date, media_id, on_main, is_active, category', 'safe', 'on'=>'search'),
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
            'name' => 'Name',
            'latin_name' => 'Latin Name',
            'announce' => 'Announce',
            'full_text' => 'Full Text',
            'tags' => 'Tags',
            'create_date' => 'Create Date',
            'media_id' => 'Media',
            'on_main' => 'On Main',
            'is_active' => 'Is Active',
            'category' => 'Category',
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
        $criteria->compare('name',$this->name,true);
        $criteria->compare('latin_name',$this->latin_name,true);
        $criteria->compare('announce',$this->announce,true);
        $criteria->compare('full_text',$this->full_text,true);
        $criteria->compare('tags',$this->tags,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('media_id',$this->media_id,true);
        $criteria->compare('on_main',$this->on_main);
        $criteria->compare('is_active',$this->is_active);
        $criteria->compare('category',$this->category,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Analytics the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function beforeValidate()
    {
        $this->create_date = empty($this->create_date) ? new CDbExpression('NOW()') : $this->create_date;
        return parent::beforeValidate();
    }
}