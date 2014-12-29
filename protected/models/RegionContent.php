<?php

/**
 * This is the model class for table "RegionContent".
 *
 * The followings are the available columns in table 'RegionContent':
 * @property string $id
 * @property string $region_id
 * @property string $logo_id
 * @property string $mayor
 * @property string $investor_support
 * @property string $investor_support_url
 * @property string $info
 * @property string $mayor_text
 * @property integer $mayor_logo
 * @property string $investor_support_text
 * @property string $administrative_center
 * @property double $area
 * @property double $populate
 * @property string $federal_district
 * @property string $times
 * @property double $gross_regional_product
 * @property double $gross_regional_product_personal
 * @property double $investment_capital
 * @property double $investment_capital_personal
 * @property double $salary
 * @property double $cost_of_living
 * @property double $foreign_investment
 * @property double $foreign_investment_person
 * @property double $weight_profit
 * @property double $unemployment
 * @property string $city
 * @property double $day_sunny
 * @property double $winter_temperatures
 * @property double $nature_zone
 * @property double $year_rain
 * @property double $summer_temperatures
 * @property string $social_overview
 * @property string $social_natural_resources
 * @property string $social_ecology
 * @property string $social_population
 * @property string $social_economy
 * @property string $investment_climate
 * @property string $investment_banking
 * @property string $investment_support_structure
 * @property string $investment_regional
 * @property string $innovation_proportion
 * @property string $innvation_costs
 * @property string $innvation_NIOKR
 * @property string $innvation_scientific_potential
 * @property string $infra_social_object
 * @property string $infra_health
 * @property string $infra_communal
 * @property string $infra_education
 * @property string $infra_sport
 * @property string $infra_transport
 * @property string $infra_trade
 * @property string $infra_organiation_turnover
 * @property string $infra_assets_deprication
 *
 * The followings are the available model relations:
 * @property Media $logo
 * @property Region $region
 */
class RegionContent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'RegionContent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('region_id', 'required'),
			array('mayor_logo', 'numerical', 'integerOnly'=>true),
			array('day_sunny, winter_temperatures, year_rain, summer_temperatures, area, populate, gross_regional_product, gross_regional_product_personal, investment_capital, investment_capital_personal, salary, cost_of_living, foreign_investment, foreign_investment_person, weight_profit, unemployment', 'numerical'),
			array('region_id, logo_id, infographic_media_id', 'length', 'max'=>10),
			array('mayor, investor_support, investor_support_url, administrative_center, federal_district, city', 'length', 'max'=>255),
			array('times', 'length', 'max'=>50),
			array('mayor_post,infographic_title', 'length', 'max'=>255),
			array('nature_zone', 'safe'),
			array('infographic_title,mayor_post,info, mayor_text, investor_support_text, social_overview, social_natural_resources, social_ecology, social_population, social_economy, investment_climate, investment_banking, investment_support_structure, investment_regional, innovation_proportion, innvation_costs, innvation_NIOKR, innvation_scientific_potential, infra_social_object, infra_health, infra_communal, infra_education, infra_sport, infra_transport, infra_trade, infra_organiation_turnover, infra_assets_deprication', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, region_id, logo_id, mayor, investor_support, investor_support_url, info, mayor_text, mayor_logo, investor_support_text, administrative_center, area, populate, federal_district, times, gross_regional_product, gross_regional_product_personal, investment_capital, investment_capital_personal, salary, cost_of_living, foreign_investment, foreign_investment_person, weight_profit, unemployment, city, day_sunny, winter_temperatures, nature_zone, year_rain, summer_temperatures, social_overview, social_natural_resources, social_ecology, social_population, social_economy, investment_climate, investment_banking, investment_support_structure, investment_regional, innovation_proportion, innvation_costs, innvation_NIOKR, innvation_scientific_potential, infra_social_object, infra_health, infra_communal, infra_education, infra_sport, infra_transport, infra_trade, infra_organiation_turnover, infra_assets_deprication', 'safe', 'on'=>'search'),
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
			'logo' => array(self::BELONGS_TO, 'Media', 'logo_id'),
			'infographic' => array(self::BELONGS_TO, 'Media', 'infographic_media_id'),
			'mayorLogo' => array(self::BELONGS_TO, 'Media', 'mayor_logo'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'region_id' => 'Region',
			'logo_id' => 'Герб',
			'infographic_media_id' => 'Инфографик',
			'mayor' => 'Руководитель региона',
			'investor_support' => 'Поддержка инвестора',
			'investor_support_url' => 'Ссылка на сайт поддержки инвестора',
			'info' => 'Информация о регионе',
			'mayor_text' => 'Слова мэра',
			'mayor_logo' => 'Портрет мэра',
			'investor_support_text' => 'О поддержке инвестирования',
			'administrative_center' => 'Административный центр',
			'area' => 'Площадь региона',
			'populate' => 'Население региона',
			'federal_district' => 'Федеральный округ',
			'times' => 'Часовой пояс',
			'gross_regional_product' => 'Валовый региональный продукт',
			'gross_regional_product_personal' => 'Валовый региональный продукт на душу населения',
			'investment_capital' => 'Инвестиции в основной капитал',
			'investment_capital_personal' => 'Инвестиции в основной капитал на душу населения',
			'salary' => 'Среднемесячная заработная плата',
			'cost_of_living' => 'Прожиточный минимум',
			'foreign_investment' => 'Объем прямых иностранных инвестиций',
			'foreign_investment_person' => 'Объем прямых иностранных инвестиций на человека',
			'weight_profit' => 'Удельный вес прибыльных предприятий',
			'unemployment' => 'Уровень зарегистрированной безработицы',
			'city' => 'Крупнейшие города',
			'day_sunny' => 'Солнечных дней в году',
			'winter_temperatures' => 'Дневная температура января',
			'nature_zone' => 'Природная зона',
			'year_rain' => 'Среднегодовой уровень осадков',
			'summer_temperatures' => 'Дневная температура июля',
			'social_overview' => 'Общие сведения о регионе',
			'social_natural_resources' => 'Природно­климатические ресурсы',
			'social_ecology' => 'Экологическая обстановка',
			'social_population' => 'Население',
			'social_economy' => 'Экономика',
			'investment_climate' => 'Инвестиционный климат',
			'investment_banking' => 'Банковская сфера',
			'investment_support_structure' => 'Структура поддержки и обслуживания бизнеса',
			'investment_regional' => 'Направления региональной инвестиционной политики',
			'innovation_proportion' => 'Инновационная активность региона',
			'innvation_costs' => 'Иновационная инфраструктура региона',
			'innvation_NIOKR' => 'Удельный вес затрат на НИОКР частных компаний региона',
			'innvation_scientific_potential' => 'Научно-образовательный потенциал региона',
			'infra_social_object' => 'Оценка обеспеченности региона объектами социально­инфраструктурных отраслей, %:',
			'infra_health' => 'Здравоохранение',
			'infra_communal' => 'ЖКХ',
			'infra_education' => 'Образование',
			'infra_sport' => 'Культурно­спортивный комплекс',
			'infra_transport' => 'Транспорт и связь',
			'infra_trade' => 'Торговля',
			'infra_organiation_turnover' => 'Оборот организаций региона, млн. руб.',
			'infra_assets_deprication' => 'Степень износа основных фондов региона, %',
			'mayor_post' => 'Должность руководителя',
			'infographic_title' => 'Заголовок инфографика',
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
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('logo_id',$this->logo_id,true);
		$criteria->compare('mayor',$this->mayor,true);
		$criteria->compare('investor_support',$this->investor_support,true);
		$criteria->compare('investor_support_url',$this->investor_support_url,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('mayor_text',$this->mayor_text,true);
		$criteria->compare('mayor_logo',$this->mayor_logo);
		$criteria->compare('investor_support_text',$this->investor_support_text,true);
		$criteria->compare('administrative_center',$this->administrative_center,true);
		$criteria->compare('area',$this->area);
		$criteria->compare('populate',$this->populate);
		$criteria->compare('federal_district',$this->federal_district,true);
		$criteria->compare('times',$this->times,true);
		$criteria->compare('gross_regional_product',$this->gross_regional_product);
		$criteria->compare('gross_regional_product_personal',$this->gross_regional_product_personal);
		$criteria->compare('investment_capital',$this->investment_capital);
		$criteria->compare('investment_capital_personal',$this->investment_capital_personal);
		$criteria->compare('salary',$this->salary);
		$criteria->compare('cost_of_living',$this->cost_of_living);
		$criteria->compare('foreign_investment',$this->foreign_investment);
		$criteria->compare('foreign_investment_person',$this->foreign_investment_person);
		$criteria->compare('weight_profit',$this->weight_profit);
		$criteria->compare('unemployment',$this->unemployment);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('day_sunny',$this->day_sunny);
		$criteria->compare('winter_temperatures',$this->winter_temperatures);
		$criteria->compare('nature_zone',$this->nature_zone);
		$criteria->compare('year_rain',$this->year_rain);
		$criteria->compare('summer_temperatures',$this->summer_temperatures);
		$criteria->compare('social_overview',$this->social_overview,true);
		$criteria->compare('social_natural_resources',$this->social_natural_resources,true);
		$criteria->compare('social_ecology',$this->social_ecology,true);
		$criteria->compare('social_population',$this->social_population,true);
		$criteria->compare('social_economy',$this->social_economy,true);
		$criteria->compare('investment_climate',$this->investment_climate,true);
		$criteria->compare('investment_banking',$this->investment_banking,true);
		$criteria->compare('investment_support_structure',$this->investment_support_structure,true);
		$criteria->compare('investment_regional',$this->investment_regional,true);
		$criteria->compare('innovation_proportion',$this->innovation_proportion,true);
		$criteria->compare('innvation_costs',$this->innvation_costs,true);
		$criteria->compare('innvation_NIOKR',$this->innvation_NIOKR,true);
		$criteria->compare('innvation_scientific_potential',$this->innvation_scientific_potential,true);
		$criteria->compare('infra_social_object',$this->infra_social_object,true);
		$criteria->compare('infra_health',$this->infra_health,true);
		$criteria->compare('infra_communal',$this->infra_communal,true);
		$criteria->compare('infra_education',$this->infra_education,true);
		$criteria->compare('infra_sport',$this->infra_sport,true);
		$criteria->compare('infra_transport',$this->infra_transport,true);
		$criteria->compare('infra_trade',$this->infra_trade,true);
		$criteria->compare('infra_organiation_turnover',$this->infra_organiation_turnover,true);
		$criteria->compare('infra_assets_deprication',$this->infra_assets_deprication,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegionContent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
