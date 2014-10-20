<?php

/**
 * This is the model class for table "Project".
 *
 * The followings are the available columns in table 'Project':
 * @property string $id
 * @property string $user_id
 * @property string $region_id
 * @property string $create_date
 * @property string $logo_id
 * @property string $file_id
 * @property string $type
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Business[] $businesses
 * @property InfrastructureProject[] $infrastructureProjects
 * @property InnovativeProject[] $innovativeProjects
 * @property InvestmentProject[] $investmentProjects
 * @property InvestmentSite[] $investmentSites
 * @property InvestmentSiteFeature[] $investmentSiteFeatures
 * @property User $user
 * @property Region $region
 * @property Media $logo
 * @property Media $file
 */
class Project extends CActiveRecord
{
    public static $urlByType = array(
        1 => 'InvestmentProject',
        2 => 'InnovativeProject',
        3 => 'InfrastructureProject',
        4 => 'InvestmentSite',
        5 => 'Business',
    );

    const T_INVEST = 1;
    const T_INNOVATE = 2;
    const T_INFRASTRUCT =3;
    const T_SITE = 4;
    const T_BUSINESS = 5;

    static $params = array(
        Project::T_INVEST => array('relation' => 'investment', 'model' => 'InvestmentProject'),
        Project::T_INNOVATE => array('relation' => 'innovative', 'model' => 'InnovativeProject'),
        Project::T_INFRASTRUCT => array('relation' => 'infrastructure', 'model' => 'InfrastructureProject'),
        Project::T_SITE => array('relation' => 'investmentSites', 'model' => 'InvestmentSite'),
        Project::T_BUSINESS => array('relation' => 'businesses', 'model' => 'Business'),
    );

    public function beforeValidate()
    {
        $this->latin_name = Candy::getLatin($this->name);
        return parent::beforeValidate();
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, type', 'required'),
            array('user_id, region_id, logo_id, file_id, type', 'length', 'max'=>10),
            array('name', 'length', 'max'=>255),
            array('create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, region_id, create_date, logo_id, file_id, type, name', 'safe', 'on'=>'search'),
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
			'businesses' => array(self::HAS_ONE, 'Business', 'project_id'),
			'infrastructure' => array(self::HAS_ONE, 'InfrastructureProject', 'project_id'),
			'innovative' => array(self::HAS_ONE, 'InnovativeProject', 'project_id'),
			'investment' => array(self::HAS_ONE, 'InvestmentProject', 'project_id'),
			'investmentSite' => array(self::HAS_ONE, 'InvestmentSite', 'project_id'),
			'investmentSiteFeatures' => array(self::HAS_MANY, 'InvestmentSiteFeature', 'project_id'),
			'file' => array(self::BELONGS_TO, 'Media', 'file_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
			'logo' => array(self::BELONGS_TO, 'Media', 'logo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'region_id' => Yii::t('main','Регион'),
            'create_date' => 'Create Date',
            'logo_id' => 'Logo',
            'file_id' => 'File',
            'type' => 'Type',
            'name' => Yii::t('main','Название'),
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
        $criteria->compare('region_id',$this->region_id,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('logo_id',$this->logo_id,true);
        $criteria->compare('file_id',$this->file_id,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('name',$this->name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getAnswer(){
        return array(1=>Yii::t('main','Да'),0=>Yii::t('main','Нет'));
    }

    public static function getIssetDrop(){
        return array(1=>Yii::t('main','Есть'),0=>Yii::t('main','Нет'));
    }

    static function getIndustryTypeDrop(){
        return array(Yii::t('main','Газовая промышленность'),Yii::t('main','Геология и разведка недр'),
            Yii::t('main','Горнодобывающая и гороперерабатывающая промышленность'),Yii::t('main','Жилищно-коммунальное хозяйство'),
            Yii::t('main','Здравохранение, соц. обеспечение'),Yii::t('main','Золотодобывающая промыщленность'),
            Yii::t('main','Информационно-вычислительное обслуживание'),Yii::t('main','Легкая промыщленность'),
            Yii::t('main','Лесная и целлюлозно-бумажная'),Yii::t('main','Машиностроение и металлообработка'),
            Yii::t('main','Медицинская промышленность'),Yii::t('main','Нефтедоб. и нефтепер. промышленность'),
            Yii::t('main','Оптовая и розничная торговля, общ. питание'),Yii::t('main','Пищевая промышленность'),
            Yii::t('main','Полиграфическая промышленность'),Yii::t('main','Промышленность строительных материалов'),
            Yii::t('main','Рыбная промышленность'),Yii::t('main','Связь'),Yii::t('main','Сельское хозяйство'),
            Yii::t('main','Стекольная и фарфоро-фаянсовая промышленность'),Yii::t('main','Строительство'),
            Yii::t('main','Топливная промышленность'),Yii::t('main','Транспорт'),Yii::t('main','Туризм и отдых'),
            Yii::t('main','Угольная промышленность'),Yii::t('main','Финансы, кредит, страхование'),Yii::t('main','Химич. и нефтехимич. промышленность'),
            Yii::t('main','Цветная металлургия'),Yii::t('main','Черная металлургия'),Yii::t('main','Электроэнергетика')
        );
    }
}
