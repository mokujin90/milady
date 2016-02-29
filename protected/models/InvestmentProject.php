<?php

/**
 * This is the model class for table "InvestmentProject".
 *
 * The followings are the available columns in table 'InvestmentProject':
 * @property string $id
 * @property string $project_id
 * @property string $finance
 * @property string $short_description
 * @property string $address
 * @property string $market_size
 * @property string $investment_form
 * @property string $investment_direction
 * @property string $financing_terms
 * @property string $products
 * @property string $max_products
 * @property string $no_finRevenue
 * @property string $no_finCleanRevenue
 * @property string $profit
 * @property string $company_legal
 * @property string $company_description
 * @property string $company_area
 * @property string $company_name
 * @property string $project_price
 * @property string $term_finance
 * @property string $stage_project
 * @property string $capital_dev
 * @property string $equipment
 * @property string $guarantee
 * @property string $full_description
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
			array('address,term_finance, short_description,project_price, investment_formFormat, products,  profit', 'required'),
            array('project_id', 'length', 'max'=>10),
            array('project_price', 'length', 'max'=>50, 'tooLong' => "Поле  «{attribute}» слишком длинное."),
            array('short_description, company_name', 'length', 'max' => 255, 'tooLong' => "Поле  «{attribute}» слишком длинное."),
            array('financeFormat,no_finRevenueFormat,market_size,max_products,full_description,no_finCleanRevenueFormat,address, investment_direction, financing_terms, company_legal, investment_formFormat,investment_directionFormat,company_description, company_area, term_finance, stage_project, capital_dev, no_finRevenue, no_finCleanRevenue, equipment, guarantee, finance', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, finance, short_description, address,  market_size,  investment_formFormat,investment_directionFormat, investment_direction, financing_terms, products, max_products, no_finRevenue, no_finCleanRevenue, profit', 'safe', 'on'=>'search'),
		);
	}

    public $finance_type_field = false;
    public function getInvestment_formFormat(){
        if($this->finance_type_field !== false){
            return $this->finance_type_field;
        }
        $result = array();
        if($this->project){
            foreach($this->project->project2FinanceType as $model){
                $result[] = $model->finance_type_id;
            }
        }
        return $result;
    }
    public function setInvestment_formFormat($value){$this->finance_type_field = $value;}

    public function getInvestment_directionFormat(){return unserialize($this->investment_direction);}
    public function setInvestment_directionFormat($value){$this->investment_direction = serialize($value);}

    public function afterSave()
    {
        parent::afterSave();
        if (is_array($this->finance_type_field)) {
            Project2FinanceType::model()->deleteAllByAttributes(array('project_id' => $this->project_id));
            foreach ($this->finance_type_field as $id) {
                $item = new Project2FinanceType();
                $item->project_id = $this->project_id;
                $item->finance_type_id = $id;
                $item->save();
            }
        }
    }
    /*public function getFinanceFormat(){
        $unserialize = unserialize($this->finance);
        return $unserialize===false ? array() : $unserialize;
    }
    public function setFinanceFormat($value){ $this->finance = $value;}

    public function getNo_finRevenueFormat(){
        $unserialize = unserialize($this->no_finRevenue);
        return $unserialize===false ? array() : $unserialize;
    }
    public function setNo_finRevenueFormat($value){ $this->no_finRevenue = $value;}

    public function getNo_finCleanRevenueFormat(){
        $unserialize = unserialize($this->no_finCleanRevenue);
        return $unserialize===false ? array() : $unserialize;
    }
    public function setNo_finCleanRevenueFormat($value){ $this->no_finCleanRevenue = $value;}*/

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
        return parent::beforeValidate();
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => Yii::t('main','ID'),
            'project_id' => Yii::t('main','Project'),
            'region_id'=>Yii::t('main','Регион'),
            'finance'=>Yii::t('main','Финансовые показатели (за 3 последних года)'),
            'short_description' => Yii::t('main','Краткое описание проекта'),
            'address' => Yii::t('main','Место реализации проекта'),
            'market_size' => Yii::t('main','Общий объем рынка, млн руб.'),
            'investment_formFormat' => Yii::t('main','Форма инвестиций'),
            'investment_form' => Yii::t('main','Форма инвестиций'),
            'investment_directionFormat' => Yii::t('main','Направления использования инвестиций'),
            'investment_direction' => Yii::t('main','Направления использования инвестиций'),
            'financing_terms' => Yii::t('main','Условия финансирования'),
            'products' => Yii::t('main','Опишите, что планируете выпускать'),
            'max_products' => Yii::t('main','Максимальный объем производства'),
            'no_finRevenue' => Yii::t('main','Выручка, млн руб. за 3 год'),
            'no_finCleanRevenue' => Yii::t('main','Чистая прибыль, млн руб. за 3 год'),
            'profit' => Yii::t('main','Среднегодовая рентабельность продаж, %'),
            'company_legal' => Yii::t('main','Юридический адрес'),
            'company_description' => Yii::t('main','Описание компании'),
            'company_area' => Yii::t('main','Отрасль реализации'),
            'company_name' => Yii::t('main','Название компании'),
            'project_price' => Yii::t('main','Полная стоимость проекта, млн руб.'),
            'term_finance' => Yii::t('main','Основные условия финансирования'),
            'stage_project' => Yii::t('main','Стадия реализации проекта'),
            'capital_dev' => Yii::t('main','Предполагаемое капитальное строительство'),
            'equipment' => Yii::t('main','Необходимое оборудование'),
            'guarantee' => Yii::t('main','Гарантии инвестиций и риски'),
            'full_description' => Yii::t('main','Полное описание'),
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
        $criteria->compare('short_description',$this->short_description,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('market_size',$this->market_size,true);
        $criteria->compare('investment_form',$this->investment_form,true);
        $criteria->compare('investment_direction',$this->investment_direction,true);
        $criteria->compare('financing_terms',$this->financing_terms,true);
        $criteria->compare('products',$this->products,true);
        $criteria->compare('max_products',$this->max_products,true);
        $criteria->compare('no_finRevenue',$this->no_finRevenue,true);
        $criteria->compare('no_finCleanRevenue',$this->no_finCleanRevenue,true);
        $criteria->compare('profit',$this->profit,true);
        $criteria->compare('company_legal',$this->company_legal,true);
        $criteria->compare('company_description',$this->company_description,true);
        $criteria->compare('company_area',$this->company_area,true);
        $criteria->compare('company_name',$this->company_name,true);
        $criteria->compare('project_price',$this->project_price,true);
        $criteria->compare('term_finance',$this->term_finance,true);
        $criteria->compare('stage_project',$this->stage_project,true);
        $criteria->compare('capital_dev',$this->capital_dev,true);
        $criteria->compare('equipment',$this->equipment,true);
        $criteria->compare('guarantee',$this->guarantee,true);

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

    static public function getInvestmentFormDrop($id = null)
    {
        if(Candy::isSerialize($id)){
            $id = unserialize($id);
        }
        $drop = array(
            Yii::t('main', 'Прямые инвестиции'),
            Yii::t('main', 'Проектное финансирование'),
            Yii::t('main', 'Кредит'),
            Yii::t('main', 'Государственно-частное партнерство'),
        );
        if(is_array($id)){
            $result = '';
            foreach($drop as $key => $item){
                if(in_array($key,$id))
                    $result[$key] = $item;
            }
            return implode(', ',$result );
        }
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

    static function getInvestmentDirectionDrop($id = null)
    {
        $drop = array(
            Yii::t('main', 'Капитальное строительство'), Yii::t('main', 'Закупка оборудования'),
            Yii::t('main', 'Финансирование первоначального резерва оборотных средств'),
        );
        return Candy::returnDictionaryValue($drop,$id);
    }

}
