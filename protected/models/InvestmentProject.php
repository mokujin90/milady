<?php

/**
 * This is the model class for table "InvestmentProject".
 *
 * The followings are the available columns in table 'InvestmentProject':
 * @property string $id
 * @property string $project_id
 * @property string $finance
 * @property string $name
 * @property string $latin_name
 * @property string $short_description
 * @property string $address
 * @property string $industry_type
 * @property string $market_size
 * @property string $project_price
 * @property string $investment_form
 * @property string $investment_sum
 * @property string $investment_direction
 * @property string $financing_terms
 * @property string $project_step
 * @property string $kap_construction
 * @property string $equipment
 * @property string $products
 * @property string $max_products
 * @property string $no_finRevenue
 * @property string $no_finCleanRevenue
 * @property string $profit
 * @property double $period
 * @property double $profit_clear
 * @property double $profit_norm
 * @property string $risk
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class InvestmentProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'InvestmentProject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('finance, short_description, address, market_size, project_price, investment_form, investment_sum, investment_direction, financing_terms, kap_construction, equipment, products, max_products, no_finRevenue, no_finCleanRevenue, profit, period, profit_clear, profit_norm, risk', 'required'),
			array('period, profit_clear, profit_norm', 'numerical'),
			array('project_id, industry_type, project_step', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, finance, short_description, address, industry_type, market_size, project_price, investment_form, investment_sum, investment_direction, financing_terms, project_step, kap_construction, equipment, products, max_products, no_finRevenue, no_finCleanRevenue, profit, period, profit_clear, profit_norm, risk', 'safe', 'on'=>'search'),
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

    public function beforeValidate()
    {
        $this->finance =  '- | - | -';
        return parent::beforeValidate();
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'finance' => 'Finance',
			'name' => 'Название инвестиционного проекта',
			'latin_name' => 'Latin Name',
			'short_description' => 'Краткое описание проекта',
			'address' => 'Адрес',
			'industry_type' => 'Отрасль реализации',
			'market_size' => 'Общий объем рынка, млн. руб.',
			'project_price' => 'Полная стоимость проекта, млн. руб.',
			'investment_form' => 'Форма инвестиций',
			'investment_sum' => 'Сумма инвестиций, млн. руб.',
			'investment_direction' => 'Направления использования инвестиций',
			'financing_terms' => 'Условия финансирования',
			'project_step' => 'Стадия реализации проекта',
			'kap_construction' => 'Предполагаемое капстроительство',
			'equipment' => 'Необходимое оборудование',
			'products' => 'Предполагаемая к выпуску продукция (услуги)',
			'max_products' => 'Предполагаемый макс. объем производства, млн.руб.\n(по видам продукции)',
			'no_finRevenue' => 'Выручка, млн. руб. за 3 год',
			'no_finCleanRevenue' => 'Чистая прибыль, млн. руб. за 3 год',
			'profit' => 'Среднегодовая рентабельность продаж, %',
			'period' => 'Срок окупаемости проекта, лет',
			'profit_clear' => 'Чистый дисконтированный доход, млн. руб.',
			'profit_norm' => 'Внутренняя норма доходности, %',
			'risk' => 'Гарантии инвестиций и риски',
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
		$criteria->compare('finance',$this->finance,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('latin_name',$this->latin_name,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('industry_type',$this->industry_type,true);
		$criteria->compare('market_size',$this->market_size,true);
		$criteria->compare('project_price',$this->project_price,true);
		$criteria->compare('investment_form',$this->investment_form,true);
		$criteria->compare('investment_sum',$this->investment_sum,true);
		$criteria->compare('investment_direction',$this->investment_direction,true);
		$criteria->compare('financing_terms',$this->financing_terms,true);
		$criteria->compare('project_step',$this->project_step,true);
		$criteria->compare('kap_construction',$this->kap_construction,true);
		$criteria->compare('equipment',$this->equipment,true);
		$criteria->compare('products',$this->products,true);
		$criteria->compare('max_products',$this->max_products,true);
		$criteria->compare('no_finRevenue',$this->no_finRevenue,true);
		$criteria->compare('no_finCleanRevenue',$this->no_finCleanRevenue,true);
		$criteria->compare('profit',$this->profit,true);
		$criteria->compare('period',$this->period);
		$criteria->compare('profit_clear',$this->profit_clear);
		$criteria->compare('profit_norm',$this->profit_norm);
		$criteria->compare('risk',$this->risk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestmentProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
