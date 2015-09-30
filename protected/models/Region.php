<?php

/**
 * This is the model class for table "Region".
 *
 * The followings are the available columns in table 'Region':
 * @property string $id
 * @property string $name
 * @property string $lat
 * @property string $lon
 * @property string $latin_name
 * @property integer $district_id
 * @property integer $is_single
 *
 * The followings are the available model relations:
 * @property Banner2Region[] $banner2Regions
 * @property Law[] $laws
 * @property News[] $news
 * @property Project[] $projects
 * @property Region2File[] $region2Files
 * @property RegionCity[] $regionCities
 * @property RegionCompany[] $regionCompanies
 * @property RegionPlace[] $regionPlaces
 * @property RegionUniversity[] $regionUniversities
 * @property User[] $users
 * @property User2Region[] $user2Regions
 */
class Region extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Region';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('district_id,name,latin_name', 'required'),
            array('district_id,is_single', 'numerical', 'integerOnly' => true),
            array('name, latin_name', 'length', 'max' => 255),
            array('lat, lon', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, latin_name, district_id, lat, lon', 'safe', 'on' => 'search'),
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
            'projects' => array(self::HAS_MANY, 'Project', 'region_id'),
            'users' => array(self::HAS_MANY, 'User', 'region_id'),
            'content' => array(self::HAS_ONE, 'RegionContent', 'region_id'),
            'district' => array(self::BELONGS_TO, 'District', 'district_id'),
            'regionCities' => array(self::HAS_MANY, 'RegionCity', 'region_id'),
            'ports' => array(self::HAS_MANY, 'RegionPlace', 'region_id', 'condition' => 'type = "port"'),
            'airports' => array(self::HAS_MANY, 'RegionPlace', 'region_id', 'condition' => 'type = "airport"'),
            'stations' => array(self::HAS_MANY, 'RegionPlace', 'region_id', 'condition' => 'type = "station"'),
            'banks' => array(self::HAS_MANY, 'RegionCompany', 'region_id', 'condition' => 'type = "bank"'),
            'businessBanks' => array(self::HAS_MANY, 'RegionCompany', 'region_id', 'condition' => 'type = "business_bank"'),
            'orgs' => array(self::HAS_MANY, 'RegionCompany', 'region_id', 'condition' => 'type = "organization"'),
            'companies' => array(self::HAS_MANY, 'RegionCompany', 'region_id', 'condition' => 'type = "company"'),
            'developmentInstitutes' => array(self::HAS_MANY, 'RegionCompany', 'region_id', 'condition' => 'type = "development_institute"'),
            'planingInfrastructs' => array(self::HAS_MANY, 'RegionCompany', 'region_id', 'condition' => 'type = "planing_infrastruct"'),
            'greatSchools' => array(self::HAS_MANY, 'RegionCompany', 'region_id', 'condition' => 'type = "great_school"'),
            'universities' => array(self::HAS_MANY, 'RegionUniversity', 'region_id'),
            'region2Files' => array(self::HAS_MANY, 'Region2File', 'region_id'),
            'laws' => array(self::HAS_MANY, 'Law', 'region_id'),
            'regionProofInvestRating' => array(self::HAS_ONE, 'RegionProof', 'region_id', 'condition' => 'attr = "invest_rating"'),
            'regionProofRiskPosition' => array(self::HAS_ONE, 'RegionProof', 'region_id', 'condition' => 'attr = "invest_risk_position"'),
            'regionProofPotentialPosition' => array(self::HAS_ONE, 'RegionProof', 'region_id', 'condition' => 'attr = "invest_potential_position"'),
            'regionProofProgressPosition' => array(self::HAS_ONE, 'RegionProof', 'region_id', 'condition' => 'attr = "inno_progress_position"'),
            'regionProofActivePosition' => array(self::HAS_ONE, 'RegionProof', 'region_id', 'condition' => 'attr = "inno_active_position"'),
		);
	}

    public function issetCoords()
    {
        return is_numeric($this->lat) && is_numeric($this->lon);
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Имя',
            'latin_name' => 'Subdomain',
            'district_id' => 'District',
            'is_single' => 'Отдельно в выпадающем списке регионов',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('latin_name', $this->latin_name, true);
        $criteria->compare('district_id', $this->district_id);
        $criteria->compare('is_single', $this->is_single);

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
     * @return Region the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Вернуть все города для dropDown листа
     */
    static function getDrop()
    {
        $criteria = new CDbCriteria();
        $criteria->order='name';
        return CHtml::listData(self::model()->findAll($criteria), 'id', 'name');
    }

    /**
     * Сформировать статистику по отраслям в этих регионах
     */
    public function getStatisticByIndustry()
    {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('COUNT(*) AS industry_count, industry_type')
            ->from('Project')
            ->where('region_id = :region_id AND status="approved"', array(':region_id' => $this->id))
            ->group('industry_type')
            ->order('industry_count')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['industry_type']) ? 'Остальное' : Project::getIndustryTypeDrop($item['industry_type']);
            $stat[] = array($name, (int)$item['industry_count']);
        }
        return $stat;
    }

    public function getStatisticByIndustryCount()
    {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('COUNT(*) AS industry_count, industry_type')
            ->from('Project')
           // ->where('region_id = :region_id AND status="approved" AND type = :type', array(':region_id' => $this->id, ':type' => Project::T_INVEST))
            ->group('industry_type')
            ->order('industry_count')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['industry_type']) ? 'Остальное' : Project::getIndustryTypeDrop($item['industry_type']);
            $stat[] = array($name, (int)$item['industry_count']);
        }
        return $stat;
    }

    public function getStatisticByIndustrySum()
    {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('SUM(investment_sum) AS industry_sum, industry_type')
            ->from('Project')
            //->where('region_id = :region_id AND status="approved" AND type = :type', array(':region_id' => $this->id, ':type' => Project::T_INVEST))
            ->group('industry_type')
            ->order('industry_sum')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['industry_type']) ? 'Остальное' : Project::getIndustryTypeDrop($item['industry_type']);
            $stat[] = array($name, (int)$item['industry_sum']);
        }
        return $stat;
    }

    public function getStatisticByTechCount()
    {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('COUNT(*) AS count_value, relevance_type')
            ->from('Project JOIN InnovativeProject ON (Project.id = InnovativeProject.project_id AND Project.type = ' . Project::T_INNOVATE . ')')
            //->where('region_id = :region_id AND status="approved"', array(':region_id' => $this->id))
            ->group('relevance_type')
            ->order('count_value')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['relevance_type']) ? 'Остальное' : InnovativeProject::getRelevanceTypeDrop($item['relevance_type']);
            $stat[] = array($name, (int)$item['count_value']);
        }
        return $stat;
    }

    public function getStatisticByTechSum()
    {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('SUM(investment_sum) AS sum_value, relevance_type')
            ->from('Project JOIN InnovativeProject ON (Project.id = InnovativeProject.project_id AND Project.type = ' . Project::T_INNOVATE . ')')
            //->where('region_id = :region_id AND status="approved"', array(':region_id' => $this->id))
            ->group('relevance_type')
            ->order('sum_value')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['relevance_type']) ? 'Остальное' : InnovativeProject::getRelevanceTypeDrop($item['relevance_type']);
            $stat[] = array($name, (int)$item['sum_value']);
        }
        return $stat;
    }

    public function getStatisticByTypeCount()
    {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('COUNT(*) AS count_value, InfrastructureProject.type')
            ->from('Project JOIN InfrastructureProject ON (Project.id = InfrastructureProject.project_id AND Project.type = ' . Project::T_INFRASTRUCT . ')')
            //->where('region_id = :region_id AND status="approved"', array(':region_id' => $this->id))
            ->group('InfrastructureProject.type')
            ->order('count_value')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['type']) ? 'Остальное' : InfrastructureProject::getTypeDrop($item['type']);
            $stat[] = array($name, (int)$item['count_value']);
        }
        return $stat;
    }

    public function getStatisticByTypeSum()
    {
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('SUM(investment_sum) AS sum_value, InfrastructureProject.type')
            ->from('Project JOIN InfrastructureProject ON (Project.id = InfrastructureProject.project_id AND Project.type = ' . Project::T_INFRASTRUCT . ')')
            //->where('region_id = :region_id AND status="approved"', array(':region_id' => $this->id))
            ->group('InfrastructureProject.type')
            ->order('sum_value')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['type']) ? 'Остальное' : InfrastructureProject::getTypeDrop($item['type']);
            $stat[] = array($name, (int)$item['sum_value']);
        }
        return $stat;
    }

    /**
     * Удельный весь количество проектов в этом регионе к общему количеству
     */
    public function getStatisticByAll()
    {
        $stat = array(array('', ''));
        $countInRegion = Project::model()->approved()->countByAttributes(array('region_id' => $this->id));
        $countAllProject = Project::model()->approved()->count();
        $partOfRegion = (100 * $countInRegion) / $countAllProject;
        $stat[] = array('Количество проектов в регионе', (int)$partOfRegion);
        $stat[] = array('Всего проектов', (int)100-$partOfRegion);
        return $stat;

    }

    /**
     *  Объем необходимых инвестиций в регионе по отраслям
     */
    public function getStatisticByInvestment(){
        $stat = array(array('', ''));
        $data = Yii::app()->db->createCommand()
            ->select('SUM(investment_sum) AS sum, industry_type')
            ->from('Project')
            ->where('region_id = :region_id AND status="approved"', array(':region_id' => $this->id))
            ->group('industry_type')
            ->order('sum')
            ->queryAll();
        foreach ($data as $item) {
            $name = is_null($item['industry_type']) ? 'Остальное' : Project::getIndustryTypeDrop($item['industry_type']);
            $stat[] = array($name, (int)$item['sum']);
        }
        return $stat;
    }
}
