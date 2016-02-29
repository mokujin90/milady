<?php

/**
 * This is the model class for table "Group".
 *
 * The followings are the available columns in table 'Group':
 * @property string $id
 * @property string $user_id
 * @property string $media_id
 * @property string $background_media_id
 * @property string $name
 * @property string $desc
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Media $backgroundMedia
 * @property User $user
 * @property Media $media
 */
class Group extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, name', 'required'),
            array('user_id, media_id, background_media_id', 'length', 'max'=>10),
            array('name', 'length', 'max'=>255, 'tooLong' => "Поле  «{attribute}» слишком длинное."),
            array('desc, create_date, type_id', 'safe'),
            array('user_id', 'unsafe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, media_id, background_media_id, name, desc, create_date', 'safe', 'on'=>'search'),
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
            'backgroundMedia' => array(self::BELONGS_TO, 'Media', 'background_media_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
            'user_id' => 'Пользователь',
            'media_id' => 'Лого',
            'background_media_id' => 'Фон',
            'name' => 'Название',
            'desc' => 'Описание',
            'create_date' => 'Create Date',
            'type_id' => 'Тип',
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
        $criteria->compare('media_id',$this->media_id,true);
        $criteria->compare('background_media_id',$this->background_media_id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('desc',$this->desc,true);
        $criteria->compare('create_date',$this->create_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Group the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}