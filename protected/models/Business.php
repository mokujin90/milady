<?php

/**
 * This is the model class for table "Business".
 *
 * The followings are the available columns in table 'Business':
 * @property string $id
 * @property string $project_id
 * @property string $leadership
 * @property string $founders
 * @property string $name
 * @property string $latin_name
 * @property string $short_description
 * @property string $property
 * @property string $means
 * @property string $reserves
 * @property string $debts
 * @property integer $has_bankruptcy
 * @property integer $has_bail
 * @property string $other
 * @property string $industry_type
 * @property integer $share
 * @property integer $price
 * @property string $address
 * @property string $age
 * @property string $revenue
 * @property string $profit
 * @property string $role_type
 */
class Business extends CActiveRecord
{
    /**
     * Значение по умолчанию
     */
    public function init(){
        if($this->isNewRecord){
            $this->role_type=0;
            $this->share = 0;
        }

    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Business';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('short_description, property, means, reserves, debts, share, price, address, age, revenue, role_type', 'required'),
			array('has_bankruptcy, has_bail, share, price', 'numerical', 'integerOnly'=>true),
			array('project_id, industry_type, role_type', 'length', 'max'=>10),
            array('profit, leadership, founders, other','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id,  leadership, founders, short_description, property, means, reserves, debts, has_bankruptcy, has_bail, other, industry_type, share, price, address, age, revenue, profit, role_type', 'safe', 'on'=>'search'),
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
			'leadership' => 'Руководство',
			'founders' => 'Учредители',
			'name' => 'Название',
			'latin_name' => 'Latin Name',
			'short_description' => 'Краткое описание бизнеса',
			'property' => 'Недвижимость (Опишите, с указанием аренда/собственность, площади, обеспеченности электричестом, связью, транспортными коммуникациями, и других существенных характеристик. Возможные способы использования (офис, склад, торговые площади, производство). По возможности укажите суммарную рыночную стоимость)',
			'means' => 'Средства производства (Перечислите наиболее значимые объекты, опишите, с указанием аренда/лизинг/собственность, наиболее важных характеристик. По возможности укажите суммарную рыночную стоимость. (основные средства, оборудование, транспорт, и т.п.))',
			'reserves' => 'Складские запасы. (Перечислите с указанием количества. По возможности укажите суммарную закупочную стоимость (товарные запасы, сырье, готовая продукция))',
			'debts' => 'Долги и обязательства. (Суммарные дебиторские и кредиторские задолжности)',
			'has_bankruptcy' => 'Находится ли бизнес в процедуре банкротства?',
			'has_bail' => 'Имеется ли имущество, находящиеся в залоге или аресте?',
			'other' => 'Дополнительная информация',
			'industry_type' => 'Отрасль',
			'share' => 'Предлагаемая доля в %',
			'price' => 'Стоимость бизнеса (млн. руб.)',
			'address' => 'Описание месторасположения',
			'age' => 'Возраст (лет)',
			'revenue' => 'Выручка в месяц (млн. руб.)',
			'profit' => 'Прибыль в месяц (млн. руб.)',
			'role_type' => 'Ваша роль при продаже бизнеса',
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
		$criteria->compare('leadership',$this->leadership,true);
		$criteria->compare('founders',$this->founders,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('property',$this->property,true);
		$criteria->compare('means',$this->means,true);
		$criteria->compare('reserves',$this->reserves,true);
		$criteria->compare('debts',$this->debts,true);
		$criteria->compare('has_bankruptcy',$this->has_bankruptcy);
		$criteria->compare('has_bail',$this->has_bail);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('industry_type',$this->industry_type,true);
		$criteria->compare('share',$this->share);
		$criteria->compare('price',$this->price);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('revenue',$this->revenue,true);
		$criteria->compare('profit',$this->profit,true);
		$criteria->compare('role_type',$this->role_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Business the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    static function getRoleTypeDrop($id = null){
        $drop = array(Yii::t('main','Посредник'),Yii::t('main','Бизнес-брокер'),Yii::t('main','Собственник'),Yii::t('main','Представитель собственника'));
        return is_null($id) ? $drop : $drop[$id];
    }
}
