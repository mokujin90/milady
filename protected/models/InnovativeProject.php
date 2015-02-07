<?php

/**
 * This is the model class for table "InnovativeProject".
 *
 * The followings are the available columns in table 'InnovativeProject':
 * @property string $id
 * @property string $project_id
 * @property string $project_description
 * @property string $project_history
 * @property string $project_address
 * @property string $project_step
 * @property string $market_size
 * @property string $financing_terms
 * @property string $product_description
 * @property string $relevance_type
 * @property string $profit
 * @property string $investment_goal
 * @property string $investment_type
 * @property string $finance_type
 * @property string $swot
 * @property string $strategy
 * @property string $exit_period
 * @property string $exit_price
 * @property string $exit_multi
 * @property string $project_price
 * @property string $invest_way
 * @property string $guarantee
 * @property string $structure
 * @property string $company_name
 * @property string $company_legal
 * @property string $company_info
 * @property string $company_area
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class InnovativeProject extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'InnovativeProject';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_description,investment_type,investment_typeFormat,company_legal,company_name,finance_type, project_price,relevance_type,project_step, product_description,  profit, investment_goal', 'required'),
            array('project_description', 'length', 'max'=>150),
            array('project_history, project_address,market_size, financing_terms, swot, strategy, exit_period, exit_price, exit_multi, invest_way, guarantee, structure, company_legal, company_info, company_area', 'safe'),
            array('project_id, project_step, relevance_type, investment_type, finance_type', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, project_id, project_description, project_history, project_address, project_step, market_size, financing_terms, product_description, relevance_type, profit, investment_goal, investment_type, finance_type, swot, strategy, exit_period, exit_price, exit_multi, project_price, invest_way, guarantee, structure, company_name, company_legal, company_info, company_area', 'safe', 'on'=>'search'),        );
    }

    public function getInvestment_typeFormat(){return unserialize($this->investment_type);}
    public function setInvestment_typeFormat($value){$this->investment_type = serialize($value);}

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
            'project_description' => 'Краткое описание проекта',
            'project_history' => 'История предыдущего финансирования',
            'project_address' => 'Адрес реализации проекта',
            'project_step' => 'Стадия проекта',
            'market_size' => 'Общий объем рынка, млн. руб.',
            'financing_terms' => 'Условия финансирования',
            'product_description' => 'Описание продукта / услуги, суть инновации',
            'relevance_type' => 'Критическая технология',
            'profit' => 'Среднегодовая рентабельность продаж, %',
            'investment_goal' => 'Цели инвестиций',
            'investment_type' => 'Тип инвесторов',
            'investment_typeFormat' => 'Тип инвесторов',
            'finance_type' => 'Тип финансирования',
            'swot' => 'Описание рисков, SWOT - анализ',
            'strategy' => 'Стратегия выхода инвесторов',
            'exit_period' => 'Планируемый срок выхода, лет',
            'exit_price' => 'Предполагаемая цена выхода, млн.руб.',
            'exit_multi' => 'Мультипликатор при выходе ("x")',
            'project_price' => Yii::t('main','Полная стоимость проекта, млн. руб.'),
            'invest_way' => Yii::t('main','Направление использования инвестиций'),
            'guarantee' => Yii::t('main','Гарантии инвестиций и риски'),
            'structure' => Yii::t('main','Объем и структура требуемых инвестиций'),
            'company_name' => Yii::t('main','Название компании'),
            'company_legal' => Yii::t('main','Юридический адрес'),
            'company_info' => Yii::t('main','Описание деятельности'),
            'company_area' => Yii::t('main','Сфера деятельности'),
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

        $criteria->compare('id',$this->id,true);
        $criteria->compare('project_id',$this->project_id,true);
        $criteria->compare('project_description',$this->project_description,true);
        $criteria->compare('project_history',$this->project_history,true);
        $criteria->compare('project_address',$this->project_address,true);
        $criteria->compare('project_step',$this->project_step,true);
        $criteria->compare('market_size',$this->market_size,true);
        $criteria->compare('financing_terms',$this->financing_terms,true);
        $criteria->compare('product_description',$this->product_description,true);
        $criteria->compare('relevance_type',$this->relevance_type,true);
        $criteria->compare('profit',$this->profit,true);
        $criteria->compare('investment_goal',$this->investment_goal,true);
        $criteria->compare('investment_type',$this->investment_type,true);
        $criteria->compare('finance_type',$this->finance_type,true);
        $criteria->compare('swot',$this->swot,true);
        $criteria->compare('strategy',$this->strategy,true);
        $criteria->compare('exit_period',$this->exit_period,true);
        $criteria->compare('exit_price',$this->exit_price,true);
        $criteria->compare('exit_multi',$this->exit_multi,true);
        $criteria->compare('project_price',$this->project_price,true);
        $criteria->compare('invest_way',$this->invest_way,true);
        $criteria->compare('guarantee',$this->guarantee,true);
        $criteria->compare('structure',$this->structure,true);
        $criteria->compare('company_name',$this->company_name,true);
        $criteria->compare('company_legal',$this->company_legal,true);
        $criteria->compare('company_info',$this->company_info,true);
        $criteria->compare('company_area',$this->company_area,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InnovativeProject the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    static public function getPatentTypeDrop($id = null)
    {
        $drop = array(Yii::t('main', 'Если есть, то указать номер патента'), Yii::t('main', 'Заявка на патент'), Yii::t('main', 'Патентный поиск'));
        return is_null($id) ? $drop : $drop[$id];
    }


    static public function getRelevanceTypeDrop($id = null)
    {
        $drop = array(
            Yii::t('main', 'Базовые и критические военные, специальные и промышленные технологии'),
            Yii::t('main', 'Биоинформационные технологии'),
            Yii::t('main', 'Биокаталитические, биосинтетические и биосенсорные технологии'),
            Yii::t('main', 'Биомедицинские и ветеринарные технологии жизнеобеспечения и защиты человека и животных'),
            Yii::t('main', 'Геномные и постгеномные технологии создания лекарственных средств'),
            Yii::t('main', 'Клеточные технологии'),
            Yii::t('main', 'Нанотехнологии и наноматериалы'),
            Yii::t('main', 'Технологии атомной энергетики, ядерного топливного цикла, безопасного обращения с радиоактивными отходами и отработавшим ядерным топливом'),
            Yii::t('main', 'Технологии биоинженерии'),
            Yii::t('main', 'Технологии водородной энергетики'),
            Yii::t('main', 'Технологии механотроники и создания микросистемной техники'),
            Yii::t('main', 'Технологии мониторинга и прогнозирования состояния атмосферы и гидросферы'),
            Yii::t('main', 'Технологии новых и возобновляемых источников энергии'),
            Yii::t('main', 'Технологии обеспечения защиты и жизнедеятельности населения и опасных объектов при угрозах террористических проявлений'),
            Yii::t('main', 'Технологии обработки, хранения, передачи и защиты информации'),
            Yii::t('main', 'Технологии оценки ресурсов и прогнозирования состояния литосферы и биосферы'),
            Yii::t('main', 'Технологии переработки и утилизации техногенных образований и отходов'),
            Yii::t('main', 'Технологии производства программного обеспечения'),
            Yii::t('main', 'Технологии производства топлив и энергии из органического сырья'),
            Yii::t('main', 'Технологии распределенных вычислений и систем'),
            Yii::t('main', 'Технологии снижения риска и уменьшения последствий природных и техногенных катастроф'),
            Yii::t('main', 'Технологии создания биосовместимых материалов'),
            Yii::t('main', 'Технологии создания интеллектуальных систем навигации и управления'),
            Yii::t('main', 'Технологии создания и обработки композиционных и керамических материалов'),
            Yii::t('main', 'Технологии создания и обработки кристаллических материалов'),
            Yii::t('main', 'Технологии создания и обработки полимеров и эластомеров'),
            Yii::t('main', 'Технологии создания и управления новыми видами транспортных систем'),
            Yii::t('main', 'Технологии создания мембран и каталитических систем'),
            Yii::t('main', 'Технологии создания новых поколений ракетно-космической, авиационной и морской техники'),
            Yii::t('main', 'Технологии создания электронной компонентной базы'),
            Yii::t('main', 'Технологии создания энергосберегающих систем транспортировки, распределения и потребления тепла и электроэнергии'),
            Yii::t('main', 'Технологии создания энергоэффективных двигателей и движителей для транспортных систем'),
            Yii::t('main', 'Технологии экологически безопасного ресурсосберегающего производства и переработки сельскохозяйственного сырья и продуктов питания'),
            Yii::t('main', 'Технологии экологически безопасной разработки месторождений и добычи полезных ископаемых'),
        );
        return is_null($id) ? $drop : $drop[$id];
    }

    static function getFinanceTypeDrop($id = null)
    {
        $drop = array(
            Yii::t('main', 'Грант'), Yii::t('main', 'Посевное финансирование'),
            Yii::t('main', 'Долговое финансирование'), Yii::t('main', 'Кредит'),Yii::t('main','Венчурное финансирование')
        );
        return is_null($id) ? $drop : $drop[$id];
    }

    static function getInvestmentTypeDrop($id = null)
    {
        $drop = array(
            Yii::t('main', 'Банк'), Yii::t('main', 'Бизнес-ангел'),Yii::t('main','Частный инвестор'),
            Yii::t('main', 'Инвестиционный фонд'), Yii::t('main', 'Фонд посевных инвестиций'),Yii::t('main','Венчурный фонд')
        );
        return is_null($id) ? $drop : $drop[$id];
    }
}

