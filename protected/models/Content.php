<?php

/**
 * This is the model class for table "Content".
 *
 * The followings are the available columns in table 'Content':
 * @property string $id
 * @property string $type
 * @property string $content
 */
class Content extends CActiveRecord
{
    const T_CONTACTS = 1;
    const T_FEEDBACK = 2;
    const T_ABOUT = 3;
    const T_COMMAND = 4;

    public function getPage()
    {
        return array(
            self::T_CONTACTS => array(
                'name' => Yii::t('main', 'Контакты')
            ),
            self::T_FEEDBACK => array(
                'name' => Yii::t('main', 'Обратная связь')
            ),
            self::T_ABOUT => array(
                'name' => Yii::t('main', 'О проекте')
            ),
            self::T_COMMAND => array(
                'name' => Yii::t('main', 'Команда')
            ),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Content';
    }
    public function beforeValidate()
    {
        $this->update_date = Candy::currentDate();
        return parent::beforeValidate();
    }

    /**
     * Получить просто имя по id (имени то в базе нет)
     * @param $id
     * @return mixed
     */
    public static function getName($id)
    {
        return self::model()->page[$id]['name'];
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type', 'length', 'max' => 5),
            array('content', 'safe'),
            array('name, url', 'required', 'on' => 'create'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, url, id, type, content', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'content' => Yii::t('main','Контент'),
            'name' => Yii::t('main','Название страницы'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('content', $this->content, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Content the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
