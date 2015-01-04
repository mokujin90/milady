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
 * @property string $market_size
 * @property string $investment_form
 * @property string $investment_direction
 * @property string $financing_terms
 * @property string $products
 * @property string $max_products
 * @property string $no_finRevenue
 * @property string $no_finCleanRevenue
 * @property string $profit
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
			array('finance, short_description, market_size,  investment_form, products, max_products, no_finRevenue, no_finCleanRevenue, profit', 'required'),
			array('project_id', 'length', 'max'=>10),
			array('investment_direction, financing_terms, address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, finance, short_description, address,  market_size,  investment_form, investment_direction, financing_terms, products, max_products, no_finRevenue, no_finCleanRevenue, profit', 'safe', 'on'=>'search'),
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
			'short_description' => 'Краткое описание проекта',
			'address' => 'Описание месторасположения',
			'market_size' => 'Общий объем рынка, млн. руб.',
			'investment_form' => 'Форма инвестиций',
			'investment_direction' => 'Направления использования инвестиций',
			'financing_terms' => 'Условия финансирования',
			'products' => 'Предполагаемая к выпуску продукция (услуги)',
			'max_products' => 'Предполагаемый макс. объем производства, млн.руб.\n(по видам продукции)',
			'no_finRevenue' => 'Выручка, млн. руб. за 3 год',
			'no_finCleanRevenue' => 'Чистая прибыль, млн. руб. за 3 год',
			'profit' => 'Среднегодовая рентабельность продаж, %',
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
		$criteria->compare('market_size',$this->market_size,true);
		$criteria->compare('investment_form',$this->investment_form,true);
		$criteria->compare('investment_direction',$this->investment_direction,true);
		$criteria->compare('financing_terms',$this->financing_terms,true);
		$criteria->compare('products',$this->products,true);
		$criteria->compare('max_products',$this->max_products,true);
		$criteria->compare('no_finRevenue',$this->no_finRevenue,true);
		$criteria->compare('no_finCleanRevenue',$this->no_finCleanRevenue,true);
		$criteria->compare('profit',$this->profit,true);

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
        $drop = array(
            Yii::t('main', 'Прямые инвестиции'),
            Yii::t('main', 'Проектное финансирование'),
            Yii::t('main', 'Кредит'),
            Yii::t('main', 'Государственно-частное партнерство'),
        );
        return is_null($id) ? $drop : $drop[$id];
    }

}
