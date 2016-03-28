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
 * @property string $file_title
 *
 * The followings are the available model relations:
 * @property Media $media
 */
class Analytics extends ActiveRecord
{

    public static function getCategoryType($item = false){
        $data =  array(
            'invest' => Yii::t('main', 'Инвестиции'),
            'inno' => Yii::t('main', 'Инновации'),
            'infra' => Yii::t('main', 'Инфраструктура'),
        );
        return $item ? $data[$item] : $data;
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
            array('is_main, on_main, is_active, view', 'numerical', 'integerOnly'=>true),
            array('name, latin_name, file_title', 'length', 'max'=>255),
            array('media_id, file_id', 'length', 'max'=>10),
            array('category', 'length', 'max'=>6),
            array('announce, tags, create_date', 'safe'),
            array(
                'source_url',
                'match', 'pattern' => '/^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})$/',
                'message' => 'Ссылка на источник не является правильным URL',
            ),
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
            'file' => array(self::BELONGS_TO, 'Media', 'file_id'),
            'sliders' => array(self::HAS_MANY, 'Analytics2Media', 'analytics_id'),
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
            'create_date' => Yii::t('main','Дата'),
            'media_id' => 'Media',
            'file_id' => 'Файл',
            'on_main' => Yii::t('main','На главной'),
            'is_main' => Yii::t('main','Большой блок'),
            'is_active' => Yii::t('main','Активность'),
            'category' => Yii::t('main','Категория'),
            'file_title' => Yii::t('main','Название файла'),
            'source_url' => Yii::t('main','Ссылка на источник'),
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

        if(isset($_GET['day']) && isset($_GET['dayType'])){
            $criteria->addCondition('DATE(create_date) ' . ($_GET['dayType'] == 'equals'? '=' : '>=') . ':day');
            $criteria->params += array('day' => $_GET['day']);
        }

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
        $this->create_date = empty($this->create_date) ? Candy::currentDate(Candy::DATE) : $this->create_date;
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


    public function isFavorite()
    {
        return Favorite::model()->count('user_id =:user AND analytics_id =:analytics', array('user' => Yii::app()->user->id, 'analytics'=> $this->id));
    }


    public function getLabel() {
        return Yii::t('main','Аналитика');
    }
}