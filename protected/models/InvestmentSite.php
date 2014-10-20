<?php

/**
 * This is the model class for table "InvestmentSite".
 *
 * The followings are the available columns in table 'InvestmentSite':
 * @property string $id
 * @property string $project_id
 * @property string $owner
 * @property string $ownership
 * @property string $location_type
 * @property string $site_address
 * @property string $site_type
 * @property string $problem
 * @property string $distance_to_district
 * @property string $distance_to_road
 * @property string $distance_to_train_station
 * @property string $distance_to_air
 * @property string $closest_objects
 * @property integer $has_fence
 * @property double $search_area
 * @property integer $has_road
 * @property integer $has_rail
 * @property integer $has_port
 * @property integer $has_mail
 * @property string $area
 * @property string $other
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class InvestmentSite extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'InvestmentSite';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner, ownership, site_address, problem, distance_to_district, distance_to_road, distance_to_train_station, distance_to_air, closest_objects, area, other', 'required'),
			array('has_fence, has_road, has_rail, has_port, has_mail', 'numerical', 'integerOnly'=>true),
			array('search_area', 'numerical'),
			array('project_id, location_type, site_type', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, owner, ownership, location_type, site_address, site_type, problem, distance_to_district, distance_to_road, distance_to_train_station, distance_to_air, closest_objects, has_fence, search_area, has_road, has_rail, has_port, has_mail, area, other', 'safe', 'on'=>'search'),
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
			'owner' => 'Владелец',
			'ownership' => 'Форма владения землей и зданиями',
			'location_type' => 'Административно-территориальная единица',
			'site_address' => 'Местоположение площадки',
			'site_type' => 'Тип площадки',
			'problem' => 'Наличие обременений',
			'distance_to_district' => 'Райцентра',
			'distance_to_road' => 'Автомагистрали',
			'distance_to_train_station' => 'Железнодорожной станции',
			'distance_to_air' => 'Аэропорта',
			'closest_objects' => 'Близлежащие производственные объекты (промышленные,\nсельскохозяйственные, иные) и расстояние до них\n(метров или км)',
			'has_fence' => 'Наличие ограждений',
			'search_area' => 'Площадь проекта (поле не выводится, используется\nпри поиске площадок)',
			'has_road' => 'Автодорога',
			'has_rail' => 'Ж/д. ветка',
			'has_port' => 'Порт, пристань',
			'has_mail' => 'Почта/телекоммуникации',
			'area' => 'Характеристика зданий и сооружений на территории участка',
			'other' => 'Дополнительная информация',
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
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('ownership',$this->ownership,true);
		$criteria->compare('location_type',$this->location_type,true);
		$criteria->compare('site_address',$this->site_address,true);
		$criteria->compare('site_type',$this->site_type,true);
		$criteria->compare('problem',$this->problem,true);
		$criteria->compare('distance_to_district',$this->distance_to_district,true);
		$criteria->compare('distance_to_road',$this->distance_to_road,true);
		$criteria->compare('distance_to_train_station',$this->distance_to_train_station,true);
		$criteria->compare('distance_to_air',$this->distance_to_air,true);
		$criteria->compare('closest_objects',$this->closest_objects,true);
		$criteria->compare('has_fence',$this->has_fence);
		$criteria->compare('search_area',$this->search_area);
		$criteria->compare('has_road',$this->has_road);
		$criteria->compare('has_rail',$this->has_rail);
		$criteria->compare('has_port',$this->has_port);
		$criteria->compare('has_mail',$this->has_mail);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('other',$this->other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestmentSite the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getLocationTypeDrop(){
        return array(Yii::t('main','Муниципальное образование'), Yii::t('main','Город'), Yii::t('main','Район'));
    }

    public static function getSiteTypeDrop(){
        return array(Yii::t('main','Модуль с прилегающими бытовыми помещениями'),Yii::t('main','Свободные земли'),
        Yii::t('main','Территория незавершенного строительства'),Yii::t('main','Складское помещение'),Yii::t('main','Производственная база'),
        Yii::t('main','Здание предприятия (указать)'),Yii::t('main','Предприятие целиком (название)'),Yii::t('main','Иное'));

    }
}
