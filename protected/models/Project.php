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
 * @property integer $period
 * @property integer $industry_type
 * @property integer $investment_sum
 * @property integer $profit_clear
 * @property integer $profit_norm
 * @property integer $lat
 * @property integer $lon
 * @property integer $url
 *
 * The followings are the available model relations:
 * @property Business[] $businesses
 * @property Favorite[] $favorites
 * @property InfrastructureProject[] $infrastructureProjects
 * @property InnovativeProject[] $innovativeProjects
 * @property InvestmentProject[] $investmentProjects
 * @property InvestmentSite[] $investmentSites
 * @property InvestmentSiteFeature[] $investmentSiteFeatures
 * @property User $user
 * @property Region $region
 * @property Media $logo
 * @property Media $file
 * @property Project2File[] $project2Files
 */
class Project extends CActiveRecord
{
    private static $favorites = null;

    public static $urlByType = array(
        1 => 'InvestmentProject',
        2 => 'InnovativeProject',
        3 => 'InfrastructureProject',
        4 => 'InvestmentSite',
        5 => 'Business',
    );

    const T_INVEST = 1;
    const T_INNOVATE = 2;
    const T_INFRASTRUCT = 3;
    const T_SITE = 4;
    const T_BUSINESS = 5;

    static $params = array(
        Project::T_INVEST => array('relation' => 'investment', 'model' => 'InvestmentProject'),
        Project::T_INNOVATE => array('relation' => 'innovative', 'model' => 'InnovativeProject'),
        Project::T_INFRASTRUCT => array('relation' => 'infrastructure', 'model' => 'InfrastructureProject'),
        Project::T_SITE => array('relation' => 'investmentSite', 'model' => 'InvestmentSite'),
        Project::T_BUSINESS => array('relation' => 'businesses', 'model' => 'Business'),
    );
    static $fieldsList = array(
        Project::T_INNOVATE => array('project_description', 'project_history', 'project_address',  'project_step', 'market_size', 'financing_terms', 'product_description', 'relevance_type', 'profit', 'investment_goal', 'investment_type', 'finance_type',  'swot', 'strategy', 'exit_period', 'exit_price', 'exit_multi'),
        Project::T_INVEST => array('short_description', 'address', 'market_size', 'investment_form', 'investment_direction', 'financing_terms', 'products', 'max_products', 'no_finRevenue', 'no_finCleanRevenue', 'profit'),
        Project::T_INFRASTRUCT => array('short_description', 'effect'),
        Project::T_BUSINESS => array('leadership', 'founders', 'short_description', 'property', 'means', 'reserves', 'assets', 'debts', 'has_bankruptcy', 'has_bail', 'other', 'industry_type', 'share', 'price', 'address', 'age', 'revenue', 'profit', 'role_type'),
        Project::T_SITE => array('owner', 'ownership', 'location_type', 'site_address', 'site_type', 'problem', 'distance_to_district', 'distance_to_road', 'distance_to_train_station', 'distance_to_air', 'closest_objects', 'has_fence', 'has_road', 'has_rail', 'has_port', 'has_mail', 'area', 'other'),
    );

    public function scopes()
    {
        return array(
            'approved'=>array(
                'condition'=>'t.status = "approved"',
            ),
        );
    }

    public function getSystemMessage()
    {
        return array(
            'leaveRequest' => array(
                'id' => 0,
                'name' => Yii::t('main', 'Оставить заявку'),
                'object'=>'investor',
                'not_author'
            ),
            'projectAnalyse' => array(
                'id' => 6,
                'name' => Yii::t('main', 'Анализ проекта'),
                'object'=>'project'
            ),
            'transactionSupport' => array(
                'id' => 7,
                'name' => Yii::t('main', 'Сопровождение сделки'),
                'object'=>'project'
            ),
            'choseProject'=>array(
                'id' => 9,
                'name' => Yii::t('main', 'Подобрать проект для инвестирования'),
                'object'=>'investor'
            ),
            'choseInvestor'=>array(
                'id' => 1,
                'name' => Yii::t('main', 'Подобрать инвестора'),
                'object'=>'initiator'
            ),
            'investConsultation' => array(
                'id' => 2,
                'name' => Yii::t('main', 'Инвестиционный консалтинг'),
                'object'=>'project'
            ),
            'innoConsultation' => array(
                'id' => 3,
                'name' => Yii::t('main', 'Инновационный консалтинг'),
                'object'=>'project'
            ),
        );
    }

    public function beforeValidate()
    {
        $this->latin_name = Candy::getLatin($this->name);
        if ($this->type == Project::T_SITE) {
            $this->profit_clear = 0;
            $this->profit_norm = 0;
            $this->period = 0;
            $this->investment_sum = 0;
        }
        return parent::beforeValidate();
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->create_date = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
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
            array('user_id, type, investment_sum, period, profit_clear, profit_norm, name,region_id', 'required'),
            array('user_id, region_id, logo_id, file_id, type, object_type', 'length', 'max' => 10),
            array('investment_sum,industry_type, period, profit_clear, profit_norm', 'numerical'),
            array('name', 'length', 'max' => 255),
            array('create_date,lat,lon,complete', 'safe'),
            array('url', 'unique','allowEmpty'=>true),
            array('url', 'match', 'not' => true,'pattern' => '/[^a-zA-Z0-9_-]/',),
            array('complete', 'numerical', 'integerOnly'=>true, 'min'=>0, 'max'=>100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, region_id, create_date, logo_id, file_id, type, name,lat,lon', 'safe', 'on' => 'search'),
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
            'investor2Projects' => array(self::HAS_MANY, 'Investor2Project', 'project_id'),
			'news' => array(self::HAS_MANY, 'ProjectNews', 'project_id', 'order' => 'id DESC'),
			'lastNews' => array(self::HAS_MANY, 'ProjectNews', 'project_id', 'order' => 'id DESC', 'limit' => 2),
            'project2Files' => array(self::HAS_MANY, 'Project2File', 'project_id'),
            'commentCount'=>array(self::STAT,'Comment','object_id','condition'=>'type="project"'),
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
            'region_id' => Yii::t('main', 'Регион'),
            'create_date' => 'Create Date',
            'logo_id' => 'Logo',
            'file_id' => 'File',
            'type' => Yii::t('main','Тип проекта'),
            'name' => Yii::t('main', 'Название'),
            'object_type' => Yii::t('main', 'Тип объекта'),
            'period' => Yii::t('main', 'Срок окупаемости проекта, лет'),
            'investment_sum' => Yii::t('main', 'Сумма инвестиций, млн. руб.'),
            'profit_clear' => Yii::t('main', 'Чистый дисконтированный доход, млн. руб.'),
            'profit_norm' => Yii::t('main', 'Внутренняя норма доходности, %'),
            'complete' => Yii::t('main', 'Степень выполнености'),
            'industry_type' => Yii::t('main', 'Отрасль'),
            'url' => Yii::t('main', 'Уникальный url'),
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
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('logo_id', $this->logo_id, true);
        $criteria->compare('file_id', $this->file_id, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    static public function getProjectStepDrop($id = null)
    {
        $drop = array(Yii::t('main', 'Start­up стадия'), Yii::t('main', 'Expansion стадия'),
            Yii::t('main', 'Exit стадия'));
        return is_null($id) ? $drop : $drop[$id];
    }

    public static function getAnswer()
    {
        return array(1 => Yii::t('main', 'Да'), 0 => Yii::t('main', 'Нет'));
    }

    public static function getIssetDrop()
    {
        return array(1 => Yii::t('main', 'Есть'), 0 => Yii::t('main', 'Нет'));
    }

    static function getIndustryTypeDrop($id = null)
    {
        $drop = array(Yii::t('main', 'Газовая промышленность'), Yii::t('main', 'Геология и разведка недр'),
            Yii::t('main', 'Горнодобывающая и гороперерабатывающая промышленность'), Yii::t('main', 'Жилищно-коммунальное хозяйство'),
            Yii::t('main', 'Здравохранение, соц. обеспечение'), Yii::t('main', 'Золотодобывающая промыщленность'),
            Yii::t('main', 'Информационно-вычислительное обслуживание'), Yii::t('main', 'Легкая промыщленность'),
            Yii::t('main', 'Лесная и целлюлозно-бумажная'), Yii::t('main', 'Машиностроение и металлообработка'),
            Yii::t('main', 'Медицинская промышленность'), Yii::t('main', 'Нефтедоб. и нефтепер. промышленность'),
            Yii::t('main', 'Оптовая и розничная торговля, общ. питание'), Yii::t('main', 'Пищевая промышленность'),
            Yii::t('main', 'Полиграфическая промышленность'), Yii::t('main', 'Промышленность строительных материалов'),
            Yii::t('main', 'Рыбная промышленность'), Yii::t('main', 'Связь'), Yii::t('main', 'Сельское хозяйство'),
            Yii::t('main', 'Стекольная и фарфоро-фаянсовая промышленность'), Yii::t('main', 'Строительство'),
            Yii::t('main', 'Топливная промышленность'), Yii::t('main', 'Транспорт'), Yii::t('main', 'Туризм и отдых'),
            Yii::t('main', 'Угольная промышленность'), Yii::t('main', 'Финансы, кредит, страхование'), Yii::t('main', 'Химич. и нефтехимич. промышленность'),
            Yii::t('main', 'Цветная металлургия'), Yii::t('main', 'Черная металлургия'), Yii::t('main', 'Электроэнергетика')
        );
        return is_null($id) ? $drop : $drop[$id];
    }

    static public function getObjectTypeDrop($id = null)
    {
        $drop = array(
            Yii::t('main', 'Банк'),
            Yii::t('main', 'Бизнес-ангел'),
            Yii::t('main', 'Венчурные фонды'),
            Yii::t('main', 'Государственный источник финансирования'),
            Yii::t('main', 'Инвестиционные компании'),
            Yii::t('main', 'Инвестиционный банк'),
            Yii::t('main', 'Инвестиционный фонд'),
            Yii::t('main', 'Индивидуальный инвестор'),
            Yii::t('main', 'Консалтинговая компания'),
            Yii::t('main', 'Лизинговые компании'),
            Yii::t('main', 'Промышленная компания'),
            Yii::t('main', 'Другие'),
        );
        return is_null($id) ? $drop : $drop[$id];
    }

    static public function getStaticProjectType($id = null)
    {
        $drop = array(
            Project::T_INVEST => Yii::t('main', 'Инвестиционный проект'),
            Project::T_INNOVATE => Yii::t('main', 'Инновационный проект'),
            Project::T_INFRASTRUCT => Yii::t('main', 'Инфраструктурный проект'),
            Project::T_SITE => Yii::t('main', 'Инвестиционная площадка'),
            Project::T_BUSINESS => Yii::t('main', 'Продажа бизнеса'),
        );
        return is_null($id) ? $drop : $drop[$id];
    }

    public function getProjectType()
    {
        $typeArr = self::getStaticProjectType();
        return $typeArr[$this->type];
    }

    public function isFavorite()
    {
        if (!self::$favorites) {
            $controller = Yii::app()->getController();
            self::$favorites = CHtml::listData($controller->user->favorites, 'id', 'project_id');
        }
        return in_array($this->id, self::$favorites);
    }

    public function issetCoords()
    {
        return is_numeric($this->lat) && is_numeric($this->lon);
    }

    public function createUrl(){
        $controller = Yii::app()->controller;
        return $controller->createUrl('project/detail', array('id' => $this->id));
    }

    public function createUserUrl(){
        $controller = Yii::app()->controller;
        return $controller->createUrl('user/' . self::$urlByType[$this->type], array('id' => $this->id));
    }

    /**
     * Переведем из числа от 0 до 100 в плашки
     * @param $count
     */
    public function getCompleteRank($countRank = 7)
    {
        return floor($this->complete * $countRank / 100);
    }

    public static function getFieldValue($model, $field){
        switch($field){
            case "industry_type":
                return Project::getIndustryTypeDrop($model->{$field});
            case "investment_form":
                return InvestmentProject::getInvestmentFormDrop($model->{$field});
            case "project_step":
                return Project::getProjectStepDrop($model->{$field});
            case "relevance_type":
                return InnovativeProject::getRelevanceTypeDrop($model->{$field});
            case "investment_type":
                return InnovativeProject::getInvestmentTypeDrop($model->{$field});
            case "finance_type":
                return InnovativeProject::getFinanceTypeDrop($model->{$field});
            case "site_type":
                return InvestmentSite::getSiteTypeDrop($model->{$field});
            case "location_type":
                return InvestmentSite::getLocationTypeDrop($model->{$field});
            case "role_type":
                return Business::getRoleTypeDrop($model->{$field});
            case "type":
                return InfrastructureProject::getTypeDrop($model->{$field});
            case "has_road":
            case "has_rail":
            case "has_port":
            case "has_mail":
            case "has_bankruptcy":
            case "has_bail":
                return $model->{$field} ? Yii::t('main', 'Да') : Yii::t('main', 'Нет');
            default:
                return $model->{$field};
        }
    }
}
