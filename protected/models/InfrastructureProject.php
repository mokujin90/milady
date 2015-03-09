<?php

/**
 * This is the model class for table "InfrastructureProject".
 *
 * The followings are the available columns in table 'InfrastructureProject':
 * @property string $id
 * @property string $project_id
 * @property string $short_description
 * @property string $effect
 * @property string $type
 * @property string $realization_place
 * @property string $company_name
 * @property string $legal_address
 * @property string $company_about
 * @property string $activity_sphere
 * @property string $dinamics
 * @property string $full_price
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class InfrastructureProject extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'InfrastructureProject';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_id, type', 'length', 'max' => 10),
            array('short_description,realization_place,full_price,effect', 'required'),
            array('short_description, effect,dinamics,activity_sphere,company_about,company_name,legal_address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, project_id, short_description, effect', 'safe', 'on' => 'search'),
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
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'project_id' => 'Project',
            'short_description' => Yii::t('main', 'Краткое описание проекта'),
            'effect' => Yii::t('main', 'Социально­экономический эффект от реализации'),
            'type' => Yii::t('main', 'Тип проекта'),
            'realization_place' => Yii::t('main', 'Место реализации проекта'),
            'company_name' => Yii::t('main', 'Название компании'),
            'legal_address' => Yii::t('main', 'Юридический адрес'),
            'company_about' => Yii::t('main', 'Описание компании'),
            'activity_sphere' => Yii::t('main', 'Сфера деятельности'),
            'dinamics' => Yii::t('main', 'Динамика реализации проекта'),
            'full_price' => Yii::t('main', 'Полная стоимость проекта, млн. руб.'),
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
        $criteria->compare('project_id', $this->project_id, true);
        $criteria->compare('short_description', $this->short_description, true);
        $criteria->compare('effect', $this->effect, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('realization_place', $this->realization_place, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('legal_address', $this->legal_address, true);
        $criteria->compare('company_about', $this->company_about, true);
        $criteria->compare('activity_sphere', $this->activity_sphere, true);
        $criteria->compare('dinamics', $this->dinamics, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InfrastructureProject the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    static public function getTypeDrop($id = null)
    {
        $drop = array(
            Yii::t('main', 'Транспорт'),
            Yii::t('main', 'Информационная инфраструктура'),
            Yii::t('main', 'Инновационная среда'),
            Yii::t('main', 'Природные ресурсы'),
            Yii::t('main', 'Бизнес'),
            Yii::t('main', 'Социальная инфраструктура'),
            Yii::t('main', 'Институциональная инфраструктура'),
            Yii::t('main', 'Экология'),
        );
        return is_null($id) ? $drop : $drop[$id];
    }
}
