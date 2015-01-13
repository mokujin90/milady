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
 * @property integer $is_main
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
            array('is_main, on_main, is_active', 'numerical', 'integerOnly'=>true),
            array('name, latin_name', 'length', 'max'=>255),
            array('media_id', 'length', 'max'=>10),
            array('category', 'length', 'max'=>6),
            array('announce, tags, create_date', 'safe'),
            array('create_date', 'date', 'format' => 'yyyy-MM-dd'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, latin_name, announce, full_text, tags, create_date, media_id, is_main, on_main, is_active, category', 'safe', 'on'=>'search'),
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
            'name' => Yii::t('main','Заголовок'),
            'latin_name' => 'Latin Name',
            'announce' => Yii::t('main','Анонс'),
            'full_text' => Yii::t('main','Текст'),
            'tags' => Yii::t('main','Теги'),
            'create_date' => 'Create Date',
            'media_id' => 'Media',
            'on_main' => Yii::t('main','На главной'),
            'is_main' => Yii::t('main','Большой блок'),
            'is_active' => Yii::t('main','Активность'),
            'category' => Yii::t('main','Категория'),
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
        $criteria->compare('is_main',$this->is_main);
        $criteria->compare('is_active',$this->is_active);
        $criteria->compare('category',$this->category,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
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

    public function createUrl(){
        $controller = Yii::app()->controller;
        return $controller->createUrl('analytics/detail', array('id' => $this->id));
    }
    /**
     * Сформировать статистику по типам проектов
     */
    public static function getStatisticByType() {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
                ->select('COUNT(*) AS project_count, type')
                ->from('Project')
                ->where('status = "approved"')
                ->group('type')
                ->order('project_count')
                ->queryAll();
        foreach ($data as $item) {
            $stat[] = array(Project::getStaticProjectType($item['type']), (int)$item['project_count']);
        }
        return $stat;
    }
    /**
     * Сформировать статистику по регонам проектов
     */
    public static function getStatisticByRegion() {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('COUNT(*) AS project_count, Region.name as region_name')
            ->from('Project')
            ->join('Region', 'Project.region_id = Region.id')
            ->where('status = "approved"')
            ->group('region_id')
            ->order('project_count DESC')
            ->limit(10)
            ->queryAll();
        foreach ($data as $item) {
            $stat[] = array($item['region_name'], (int)$item['project_count']);
        }
        return $stat;
    }

    public static function getStatisticByInvestmentSum(){
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('SUM(investment_sum) AS sum, Region.name as region_name')
            ->from('Project')
            ->join('Region', 'Project.region_id = Region.id')
            ->where('status = "approved"')
            ->group('region_id')
            ->order('sum DESC')
            ->limit(10)
            ->queryAll();
        foreach ($data as $item) {
            $stat[] = array($item['region_name'], (int)$item['sum']);
        }
        return $stat;
    }
}