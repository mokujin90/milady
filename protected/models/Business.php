<?php

/**
 * This is the model class for table "Business".
 *
 * The followings are the available columns in table 'Business':
 * @property string $id
 * @property string $project_id
 * @property string $leadership
 * @property string $founders
 * @property string $short_description
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
 * @property string $legal_address
 * @property string $post_address
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $history
 * @property string $business_name
 * @property string $operational_cost
 * @property string $wage_fund
 * @property string $activity_sphere
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class Business extends CActiveRecord
{
    /**
     * Значение по умолчанию
     */
    public function init()
    {
        if ($this->isNewRecord) {
            $this->role_type = 0;
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
            array('legal_address,wage_fund,operational_cost,profit,activity_sphere,phone,fax,email,leadership,business_name,history,short_description, debts, share, price, address, age, revenue', 'required'),
            array('has_bankruptcy, has_bail, share, price', 'numerical', 'integerOnly' => true),
            array('project_id, industry_type, role_type', 'length', 'max' => 10),
            array('phone, fax', 'length', 'max' => 100),
            array('email, business_name', 'length', 'max' => 255),
            array('operational_cost, wage_fund', 'length', 'max' => 50),
            array('leadership, founders, other, profit, legal_address, post_address, history, activity_sphere', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, project_id, leadership, founders, short_description, debts, has_bankruptcy, has_bail, other, industry_type, share, price, address, age, revenue, profit, role_type, legal_address, post_address, phone, fax, email, history, business_name, operational_cost, wage_fund, activity_sphere', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('main', 'ID'),
            'project_id' => Yii::t('main', 'Project'),
            'leadership' => Yii::t('main', 'Руководство'),
            'founders' => Yii::t('main', 'Акционеры'),
            'short_description' => Yii::t('main', 'Краткое описание бизнеса'),
            'debts' => Yii::t('main', 'Долги и обязательства'),
            'has_bankruptcy' => Yii::t('main', 'Находится ли бизнес в процедуре банкротства?'),
            'has_bail' => Yii::t('main', 'Имеется ли имущество, находящиеся в залоге или аресте?'),
            'other' => Yii::t('main', 'Дополнительная информация'),
            'industry_type' => Yii::t('main', 'Отрасль'),
            'share' => Yii::t('main', 'Предлагаемая доля в %'),
            'price' => Yii::t('main', 'Стоимость бизнеса (млн. руб.)'),
            'address' => Yii::t('main', 'Месторасположение'),
            'age' => Yii::t('main', 'Возраст (лет)'),
            'revenue' => Yii::t('main', 'Выручка в месяц (млн. руб.)'),
            'profit' => Yii::t('main', 'Прибыль в месяц (млн. руб.)'),
            'role_type' => Yii::t('main', 'Ваша роль при продаже бизнеса'),
            'legal_address' => Yii::t('main', 'Юридический адрес'),
            'post_address' => Yii::t('main', 'Почтовый адрес'),
            'phone' => Yii::t('main', 'Телефон (с кодом)'),
            'fax' => Yii::t('main', 'Факс (с кодом)'),
            'email' => Yii::t('main', 'E-mail'),
            'history' => Yii::t('main', 'Историческая справка'),
            'business_name' => Yii::t('main', 'Название'),
            'operational_cost' => Yii::t('main', 'Операционные расходы (млн.руб.)'),
            'wage_fund' => Yii::t('main', 'Фонд заработной платы в месяц (млн.руб.)'),
            'activity_sphere' => Yii::t('main', 'Сфера деятельности'),
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
        $criteria->compare('project_id', $this->project_id, true);
        $criteria->compare('leadership', $this->leadership, true);
        $criteria->compare('founders', $this->founders, true);
        $criteria->compare('short_description', $this->short_description, true);
        $criteria->compare('debts', $this->debts, true);
        $criteria->compare('has_bankruptcy', $this->has_bankruptcy);
        $criteria->compare('has_bail', $this->has_bail);
        $criteria->compare('other', $this->other, true);
        $criteria->compare('industry_type', $this->industry_type, true);
        $criteria->compare('share', $this->share);
        $criteria->compare('price', $this->price);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('age', $this->age, true);
        $criteria->compare('revenue', $this->revenue, true);
        $criteria->compare('profit', $this->profit, true);
        $criteria->compare('role_type', $this->role_type, true);
        $criteria->compare('legal_address', $this->legal_address, true);
        $criteria->compare('post_address', $this->post_address, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('history', $this->history, true);
        $criteria->compare('business_name', $this->business_name, true);
        $criteria->compare('operational_cost', $this->operational_cost, true);
        $criteria->compare('wage_fund', $this->wage_fund, true);
        $criteria->compare('activity_sphere', $this->activity_sphere, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Business the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    static function getRoleTypeDrop($id = null)
    {
        $drop = array(Yii::t('main', 'Посредник'), Yii::t('main', 'Бизнес-брокер'), Yii::t('main', 'Собственник'), Yii::t('main', 'Представитель собственника'));
        return is_null($id) ? $drop : $drop[$id];
    }
}
