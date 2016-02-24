<?php

/**
 * This is the model class for table "Project".
 *
 * The followings are the available columns in table 'Project':
 * @property string $id
 * @property string $user_id
 * @property string $region_id
 * @property string $status
 * @property string $create_date
 * @property string $logo_id
 * @property string $file_id
 * @property string $type
 * @property string $name
 * @property string $latin_name
 * @property string $object_type
 * @property string $investment_sum
 * @property string $period
 * @property string $profit_norm
 * @property string $profit_clear
 * @property string $lat
 * @property string $lon
 * @property integer $complete
 * @property string $industry_type
 * @property string $url
 * @property string $contact_partner
 * @property string $contact_address
 * @property string $contact_face
 * @property string $contact_role
 * @property string $contact_phone
 * @property string $contact_fax
 * @property string $contact_email
 * @property string $has_user_contact
 * @property string $has_user_company
 * @property string $company_name
 * @property string $company_legal
 * @property string $company_about
 * @property string $company_sphere
 * @property string $is_disable
 *
 * The followings are the available model relations:
 * @property Business[] $businesses
 * @property Favorite[] $favorites
 * @property InfrastructureProject[] $infrastructure
 * @property InnovativeProject[] $innovative
 * @property InvestmentProject[] $investmentProjects
 * @property InvestmentSite[] $investmentSites
 * @property InvestmentSiteFeature[] $investmentSiteFeatures
 * @property Investor2Project[] $investor2Projects
 * @property Message[] $messages
 * @property User $user
 * @property Region $region
 * @property Media $logo
 * @property Media $file
 * @property Project2File[] $project2Files
 * @property ProjectNews[] $projectNews
 */
class Project extends CActiveRecord
{
    public $count = 0;
    public $company_name;
    public $company_legal;
    public $company_about;
    public $company_sphere;
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
        Project::T_INNOVATE => array(
            'resume' => array(
                'name' => 'Резюме проекта',
                'items' => array(
                    'name' => 'name',
                    'project_description' => 'tiny',
                    'project_history' => 'tiny',
                    'region_id' => 'region',
                    'project_step' => 'getProjectStepDrop',
                    'market_size' => 'text',
                    'project_price' => 'project_price',
                    'investment_sum' => 'investment_sum',
                    'invest_way' => 'invest_way',
                )
            ),
            'description' => array(
                'name' => 'Описание проекта',
                'items' => array(
                    'product_description' => 'tiny',
                    'relevance_type' => 'getRelevanceTypeDrop',
                )
            ),
            'finance' => array(
                'name' => 'Финансовый план',
                'items' => array(
                    'profit' => 'text',
                    'period' => 'text',
                    'profit_clear' => 'text',
                    'profit_norm' => 'text',
                    'guarantee' => 'text',
                    'structure' => 'text',
                )
            ),
            'offer' => array(
                'name' => 'Предложение инвестору',
                'items' => array(
                    'investment_goal' => 'text',
                    'finance_type' => 'getFinanceTypeDrop',
                    'financing_terms' => 'tiny',
                )
            ),
            'risk' => array(
                'name' => 'Риски проекта',
                'items' => array(
                    'swot' => 'tiny',
                )
            ),
            'exit' => array(
                'name' => 'Выход из проекта',
                'items' => array(
                    'strategy' => 'tiny',
                    'exit_period' => 'text',
                    'exit_price' => 'text',
                    'exit_multi' => 'text',
                )
            ),
        ),
        Project::T_INVEST => array(
            'resume' => array(
                'name' => 'Резюме проекта',
                'items' => array(
                    'name' => 'name',
                    'company_area' => 'getIndustryTypeDrop',
                    'short_description' => 'tiny',
                    'full_description' => 'tiny',
                    'address' => 'text',
                    'region_id' => 'region',
                    'market_size' => 'text',
                    'project_price' => 'text',
                    'investment_form' => 'getFinanceTypeDrop',
                    'investment_sum' => 'text',
                    'investment_direction' => 'getInvestmentDirectionDrop',
                    'term_finance' => 'tiny',
                    'financing_terms' => 'tiny',
                )
            ),
            'contact' => array(
                'name' => 'Информация о компании',
                'items' => array(
                    'company_name' => 'text',
                    'legal_address' => 'text',
                    'company_description' => 'text',
                    'company_area' => 'getIndustryTypeDrop',
                ),
            ),
            'org_plan' => array(
                'name' => 'Организационный план',
                'items' => array(
                    'stage_project' => 'getProjectStepDrop',
                    'capital_dev' => 'tiny',
                    'equipment' => 'tiny',
                )
            ),
            'equipment_plan' => array(
                'name' => 'Производственный план',
                'items' => array(
                    'products' => 'tiny',
                    'max_products' => 'tiny',
                )
            ),
            'finance_plan' => array(
                'name' => 'Производственный план',
                'items' => array(
                    'no_finRevenue' => 'tiny',
                    'no_finCleanRevenue' => 'tiny',
                    'finance' => 'tiny',
                    'profit' => 'text',
                    'profit_clear' => 'text',
                    'profit_norm' => 'text',
                    'guarantee' => 'tiny',
                    'object_type' => 'getObjectTypeDrop',
                )
            ),

        ),
        Project::T_INFRASTRUCT => array(
            'resume' => array(
                'name' => 'Резюме проекта',
                'items' => array(
                    'name' => 'name',
                    'short_description' => 'tiny',
                    'realization_place' => 'tiny',
                    'region' => 'region',
                    'industry_type' => 'getIndustryTypeDrop',
                    'full_price' => 'text',
                    'investment_sum' => 'text',
                    'period' => 'text',
                    'profit_norm' => 'text',
                    'effect' => 'text',
                    'type' => 'getTypeDrop',
                )
            ),
            'contact' => array(
                'name' => 'Информация о компании',
                'items' => array(
                    'company_name' => 'text',
                    'legal_address' => 'text',
                    'company_about' => 'text',
                    'activity_sphere' => 'getIndustryTypeDrop',
                ),
            ),
            'info' => array(
                'name' => '',
                'items' => array(
                    'dinamics' => 'tiny',
                )
            ),
        ),
        Project::T_BUSINESS => array(
            'resume' => array(
                'name' => 'Информация о компании',
                'items' => array(
                    'name' => 'name',
                    'legal_address' => 'text',
                    'post_address' => 'text',
                    'phone' => 'text',
                    'fax' => 'text',
                    'email' => 'text',
                    'leadership' => 'text',
                    'history' => 'tiny',
                    'founders' => 'text',
                    'activity_sphere' => 'tiny',
                    'other' => 'tiny',
                )
            ),
            'info' => array(
                'name' => 'Информация о продаваемом бизнесе',
                'items' => array(
                    'business_name' => 'text',
                    'short_description' => 'tiny',
                    'industry_type' => 'getIndustryTypeDrop',
                    'share' => 'text',
                    'price' => 'text',
                    'region_id' => 'region',
                    'address' => 'text',
                    'age' => 'text',
                    'revenue' => 'text',
                    'profit' => 'text',
                    'operational_cost' => 'text',
                    'wage_fund' => 'text',
                    'debts' => 'text',
                    'has_bankruptcy' => 'radio',
                    'has_bail' => 'radio',
                ),
            ),
        ),
        Project::T_SITE => array(
            'resume' => array(
                'name' => 'Информация о компании',
                'items' => array(
                    'name' => 'name',
                    'owner' => 'text',
                    'ownership' => 'getOwnershipDrop',
                    'region_id' => 'region',
                    'site_address' => 'text',
                    'site_type' => 'getSiteTypeDrop',
                    'problem' => 'tiny',
                )
            ),
            'distance' => array(
                'name' => 'Удаленность от ближайшего',
                'items' => array(
                    'distance_to_district' => 'text',
                    'distance_to_road' => 'text',
                    'distance_to_train_station' => 'text',
                    'distance_to_air' => 'text',
                    'closest_objects' => 'tiny',
                    'has_fence' => 'radio',
                )
            ),
            'param' => array(
                'name' => 'Характеристика территории участка',
                'items' => array(
                    'param_space' => 'text',
                    'param_expansion' => 'radio',
                    'param_expansion_size' => 'text',
                    'param_earth_category' => 'text',
                    'param_relief' => 'text',
                    'param_ground' => 'text',
                )
            ),
            'communication' => array(
                'name' => 'Собственные транспортные коммуникации',
                'items' => array(
                    'has_road' => 'radio',
                    'has_rail' => 'radio',
                    'has_port' => 'radio',
                    'has_mail' => 'radio',
                    'area' => 'tiny',
                )
            ),
            'adv' => array(
                'name' => 'Дополнительная информация',
                'items' => array(
                    'other' => 'tiny',
                    'industry_type' => 'getIndustryTypeDrop',
                    'location_type' => 'getLocationTypeDrop',
                )
            ),
            'building' => array(
                'name' => 'Характеристика зданий и сооружений на территории участка',
                'items' => array(
                    'area' => 'InvestmentSite2Building',
                    'infrastructure_site' => 'InvestmentSite2Infrastructure',
                )
            ),
        ),
    );

    public function scopes()
    {
        return array(
            'approved' => array(
                'condition' => 't.status = "approved"',
            ),
        );
    }

    public function getSystemMessage()
    {
        return array(
            'leaveRequest' => array(
                'id' => 0,
                'name' => Yii::t('main', 'Оставить заявку'),
                'object' => 'investor',
                'not_author'
            ),
            'projectAnalyse' => array(
                'id' => 6,
                'name' => Yii::t('main', 'Анализ проекта'),
                'object' => 'project'
            ),
            'transactionSupport' => array(
                'id' => 7,
                'name' => Yii::t('main', 'Сопровождение сделки'),
                'object' => 'project'
            ),
            'choseProject' => array(
                'id' => 9,
                'name' => Yii::t('main', 'Подобрать проект для инвестирования'),
                'object' => 'investor'
            ),
            'choseInvestor' => array(
                'id' => 1,
                'name' => Yii::t('main', 'Подобрать инвестора'),
                'object' => 'initiator'
            ),
            'investConsultation' => array(
                'id' => 2,
                'name' => Yii::t('main', 'Инвестиционный консалтинг'),
                'object' => 'project'
            ),
            'innoConsultation' => array(
                'id' => 3,
                'name' => Yii::t('main', 'Инновационный консалтинг'),
                'object' => 'project'
            ),
            'feedback' => array(
                'id' => 10,
                'name' => Yii::t('main', 'Обратная связь'),
                'object' => 'project'
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
     * Чуть усложненный метод валидации, который зависит от типа проекта. Вся беда в том, что у разных типов
     * проекта разные правила валидации для контактных данных
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $validation = array();
        if ($this->type != self::T_BUSINESS) {
            $validation = array(array('investment_sum, period, profit_clear, profit_norm', 'required'));
        }
        /*$validContact = array();
        switch ($this->type) {
            case self::T_INFRASTRUCT:
                $validContact = array('industry_type');
                break;
            case self::T_INVEST:
            case self::T_INNOVATE:
            case self::T_BUSINESS:
                $validContact = array('industry_type');
                break;
        }
        if(count($validContact)){
            $validation +=array(array(implode(',',$validContact),'required'));

        }*/
        $validation = array_merge($validation, array(
            array('user_id, type, name,region_id', 'required'),
            array('user_id,has_user_contact,has_user_company, region_id, logo_id, file_id, type, object_type', 'length', 'max' => 10),
            array('name', 'length', 'max' => 50),
            array('investment_sum,industry_type, period, profit_clear, profit_norm,is_disable', 'numerical'),
            array('name', 'length', 'max' => 255),
            array('create_date,lat,lon,complete,contact_partner,contact_address,contact_face,contact_email,contact_fax,contact_phone,contact_role,contact_fax', 'safe'),
            array('url', 'unique', 'allowEmpty' => true),
            array('url', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9_-]/',),
            array('complete', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, region_id, create_date, logo_id, file_id, type, name,lat,lon', 'safe', 'on' => 'search'),
        ));
        return $validation;
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
            'commentCount' => array(self::STAT, 'Comment', 'object_id', 'condition' => 'type="project"'),
            'project2FinanceType' => array(self::HAS_MANY, 'Project2FinanceType', 'project_id'),
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
            'region_id' => Yii::t('main', 'Регион'),
            'create_date' => 'Дата создания',
            'logo_id' => 'Лого',
            'file_id' => 'Файл',
            'type' => Yii::t('main', 'Тип проекта'),
            'name' => Yii::t('main', 'Название'),
            'object_type' => Yii::t('main', 'Тип объекта'),
            'period' => Yii::t('main', 'Срок окупаемости проекта, лет'),
            'investment_sum' => Yii::t('main', 'Сумма инвестиций, млн. руб.'),
            'profit_clear' => Yii::t('main', 'Чистый дисконтированный доход, млн. руб.'),
            'profit_norm' => Yii::t('main', 'Внутренняя норма доходности, %'),
            'complete' => Yii::t('main', 'Степень выполнености'),
            'industry_type' => Yii::t('main', 'Отрасль'),
            'url' => Yii::t('main', 'Уникальный url'),
            'contact_partner' => Yii::t('main', 'Партнер по переговорам'),
            'contact_address' => Yii::t('main', 'Адрес'),
            'contact_face' => Yii::t('main', 'Контактное лицо'),
            'contact_role' => Yii::t('main', 'Должность'),
            'contact_phone' => Yii::t('main', 'Телефон (с кодом)'),
            'contact_fax' => Yii::t('main', 'Факс (с кодом)'),
            'contact_email' => Yii::t('main', 'E-mail'),
            'has_user_contact' => Yii::t('main', 'Использовать из профиля'),
            'has_user_company' => Yii::t('main', 'Использовать из профиля'),
            'is_disable' => Yii::t('main', 'Скрыть проект')
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
    public function search($isApproved = true)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('logo_id', $this->logo_id, true);
        $criteria->compare('file_id', $this->file_id, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('latin_name', $this->latin_name, true);
        $criteria->compare('object_type', $this->object_type, true);
        $criteria->compare('investment_sum', $this->investment_sum, true);
        $criteria->compare('period', $this->period, true);
        $criteria->compare('profit_norm', $this->profit_norm, true);
        $criteria->compare('profit_clear', $this->profit_clear, true);
        $criteria->compare('lat', $this->lat, true);
        $criteria->compare('lon', $this->lon, true);
        $criteria->compare('complete', $this->complete);
        $criteria->compare('industry_type', $this->industry_type, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('contact_partner', $this->contact_partner, true);
        $criteria->compare('contact_address', $this->contact_address, true);
        $criteria->compare('contact_face', $this->contact_face, true);
        $criteria->compare('contact_role', $this->contact_role, true);
        $criteria->compare('contact_phone', $this->contact_phone, true);
        $criteria->compare('contact_fax', $this->contact_fax, true);
        $criteria->compare('contact_email', $this->contact_email, true);

        $criteria->addCondition($isApproved ? 't.status="approved"' :  't.status!="approved"');
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
        return is_null($id) ? $drop : @$drop[$id];
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

    static function getFinanceTypeDrop($id = null)
    {
        $drop = array(
            Yii::t('main', 'Грант'), Yii::t('main', 'Лизинг'),
            Yii::t('main', 'Долговое финансирование'), Yii::t('main', 'Кредит'),Yii::t('main','Долевое финансирование'),
            Yii::t('main','Акционерный капитал'), Yii::t('main','Франчайзинг'),
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

    /**
     * Заполнить наши виртуальные поля о компании для каждого проекта в соотвествии с логикой
     */
    public function setAdvancedInfo()
    {
        /*if (!$this->has_user_company && $this->type == self::T_INFRASTRUCT) {
            $attributes = array('company_name' => $this->infrastructure->company_name, 'company_legal' => $this->infrastructure->legal_address,
                'company_about' => $this->infrastructure->company_about, 'company_sphere' => $this->infrastructure->activity_sphere);
        } elseif (!$this->has_user_company && $this->type == self::T_INNOVATE) {
            $attributes = array('company_name' => $this->innovative->company_name, 'company_legal' => $this->innovative->company_legal,
                'company_about' => $this->innovative->company_info, 'company_sphere' => $this->innovative->company_area);
        } else {
            $attributes = array('company_name' => $this->user->company_name, 'company_legal' => $this->user->company_address,
                'company_about' => $this->user->company_description, 'company_sphere' => $this->user->company_scope);
        }
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }*/
        if ($this->has_user_contact) {
            $this->contact_face = $this->user->name;
            $this->contact_role = $this->user->post;
            $this->contact_address = $this->user->contact_address;
            $this->contact_phone = $this->user->phone;
            $this->contact_fax = $this->user->fax;
            $this->contact_email = $this->user->contact_email;
        }
    }

    public function createUrl()
    {
        $controller = Yii::app()->controller;
        return $controller->createUrl('project/detail', array('id' => $this->id));
    }

    public function createUserUrl()
    {
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

    /**
     * @param $model CActiveRecord
     * @param $field
     * @return array|mixed|string
     */
    public static function getFieldValue($model, $field, $type)
    {

        /*if ($model->tableName() == self::$urlByType[Project::T_INVEST]) {
            if (in_array($field, array("no_finRevenue", "no_finCleanRevenue", 'finance'))) {
                $attribute = $field . "Format";
                return Yii::app()->controller->widget('crud.grid',
                    array('header' => array('one' => '1 год', 'two' => '2год', 'three' => '3 год',),
                        'data' => array($model->$attribute),
                        'name' => $field,
                        'action' => 1,
                        'options' => array('button' => false)
                    ), true);
            }
        }*/
        if(empty($model->{$field}) && !in_array($type,array('InvestmentSite2Building','InvestmentSite2Infrastructure','radio'))){
            return null;
        }
        switch ($type) {
            case "InvestmentSite2Building":
                return Yii::app()->controller->widget('crud.grid',
                    array('model'=>$model->buildings, 'header'=>InvestmentSite2Building::getHeader(),
                        'options'=>array('button' => false),'name'=>'InvestmentSite2Building', 'action' => 1,
                    ),true);
            case "InvestmentSite2Infrastructure":
                return Yii::app()->controller->widget('crud.grid',
                    array('model'=>$model->generateInfrastructure(), 'header'=>InvestmentSite2Infrastructure::getHeader(),
                        'options'=>array('button' => false),'name'=>'InvestmentSite2Infrastructure', 'action' => 1,
                    ),true);
            case "region":
                return Region::model()->findByPk($model->{$field})->name;
            case "getObjectTypeDrop":
                return Project::getObjectTypeDrop($model->{$field});
            case "getIndustryTypeDrop":
                return Project::getIndustryTypeDrop($model->{$field});
            case "getInvestmentFormDrop":
                return InvestmentProject::getInvestmentFormDrop($model->{$field});
            case "getProjectStepDrop":
                return Project::getProjectStepDrop($model->{$field});
            case "getRelevanceTypeDrop":
                return InnovativeProject::getRelevanceTypeDrop($model->{$field});
            case "getInvestmentTypeDrop":
                return InnovativeProject::getInvestmentTypeDrop($model->{$field});
            case "getFinanceTypeDrop":
                return InnovativeProject::getFinanceTypeDrop($model->{$field});
            case "getInvestmentDirectionDrop":
                return InvestmentProject::getInvestmentDirectionDrop($model->{$field});
            case "getSiteTypeDrop":
                return InvestmentSite::getSiteTypeDrop($model->{$field});
            case "getLocationTypeDrop":
                return InvestmentSite::getLocationTypeDrop($model->{$field});
            case "getRoleTypeDrop":
                return Business::getRoleTypeDrop($model->{$field});
            case "getTypeDrop":
                return InfrastructureProject::getTypeDrop($model->{$field});
            case "getOwnershipDrop":
                return InvestmentSite::getOwnershipDrop($model->{$field});
            case "getIssetDrop":
                return Project::getIssetDrop($model->{$field});
            case "radio":
                return $model->{$field} ? Yii::t('main', 'Да') : Yii::t('main', 'Нет');
            default:
                return $model->{$field};
        }
    }

    public function getCompanyAttr($attr){
        if($this->has_user_company) {
            return $this->user->{$attr};
        } else {
            if($attr == "company_name") {
                switch ($this->type) {
                    case Project::T_BUSINESS:
                        return $this->name;
                    case Project::T_INVEST:
                        return $this->investment->company_name;
                    case Project::T_INFRASTRUCT:
                        return $this->infrastructure->company_name;
                    case Project::T_INNOVATE:
                        return $this->innovative->company_name;
                    case Project::T_SITE:
                        return $this->user->company_name;
                }
            } else {
                return $this->{$attr};
            }
        }
    }

    public function getContactAttr($attr){
        if($this->has_user_contact) {
            if($attr == "contact_face") {
                return $this->user->name;
            } elseif($attr == "contact_role"){
                return $this->user->post;
            } elseif($attr == "contact_phone"){
                return $this->user->phone;
            } elseif($attr == "contact_fax"){
                return $this->user->fax;
            }
            return $this->user->{$attr};
        } else {
            if($attr == "company_name") {
                switch ($this->type) {
                    case Project::T_BUSINESS:
                        return $this->name;
                    case Project::T_INVEST:
                        return $this->investment->company_name;
                    case Project::T_INFRASTRUCT:
                        return $this->infrastructure->company_name;
                    case Project::T_INNOVATE:
                        return $this->innovative->company_name;
                    case Project::T_SITE:
                        return $this->user->company_name;
                }
            } else {
                return $this->{$attr};
            }
        }
    }
}
