<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property string $id
 * @property string $login
 * @property string $password
 * @property string $type
 * @property string $name
 * @property string $phone
 * @property string $post
 * @property string $fax
 * @property string $email
 * @property string $company_name
 * @property string $company_address
 * @property string $company_form
 * @property string $company_description
 * @property string $company_scope
 * @property string $inn
 * @property string $ogrn
 * @property string $logo_id
 * @property string $region_id
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 * @property Region $region
 * @property Media $logo
 */
class User extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'User';
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login, password', 'required'),
            array('email','unique'),
            array('email','email'),
            array('login, password, name, phone, post, fax, email, company_name, company_address, company_form, inn, ogrn', 'length', 'max'=>255),
            array('type', 'length', 'max'=>9),
            array('logo_id, region_id', 'length', 'max'=>10),
            array('company_description, company_scope', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, login, password, type, name, phone, post, fax, email, company_name, company_address, company_form, company_description, company_scope, inn, ogrn, logo_id, region_id', 'safe', 'on'=>'search'),
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
            'projects' => array(self::HAS_MANY, 'Project', 'user_id'),
            'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
            'logo' => array(self::BELONGS_TO, 'Media', 'logo_id'),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => Yii::t('main','Логин'),
            'password' => Yii::t('main','Пароль'),
            'type' => Yii::t('main',''),
            'name' => Yii::t('main','ФИО'),
            'phone' => Yii::t('main','Телефон'),
            'post' => Yii::t('main','Должность'),
            'email' => Yii::t('main','E-mail'),
            'company_name' => Yii::t('main','Наименование'),
            'company_form' => Yii::t('main','Форма'),
            'company_description' => Yii::t('main','Описание компании'),
            'company_scope' => Yii::t('main','Сфера деятельности'),
            'company_address' => Yii::t('main','Адрес компании'),
            'inn' => Yii::t('main','ИНН'),
            'ogrn' => Yii::t('main','ОГРН'),
            'logo_id' => Yii::t('main','Логотип'),
            'region_id' => Yii::t('main',''),
            'fax' => 'Факс',
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
        $criteria->compare('login',$this->login,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('post',$this->post,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('company_name',$this->company_name,true);
        $criteria->compare('company_address',$this->company_address,true);
        $criteria->compare('company_form',$this->company_form,true);
        $criteria->compare('company_description',$this->company_description,true);
        $criteria->compare('company_scope',$this->company_scope,true);
        $criteria->compare('inn',$this->inn,true);
        $criteria->compare('ogrn',$this->ogrn,true);
        $criteria->compare('logo_id',$this->logo_id,true);
        $criteria->compare('region_id',$this->region_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function getUserType(){
        return array('investor'=>Yii::t('main','Инвестор'),'initiator'=>Yii::t('main','Инициатор'));
    }
}