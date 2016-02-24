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
 * @property string $is_active
 * @property string $company_name
 * @property string $company_address
 * @property string $company_form
 * @property string $company_description
 * @property string $company_scope
 * @property string $inn
 * @property string $ogrn
 * @property string $logo_id
 * @property string $region_id
 * @property string $investor_country_id
 * @property string $investor_type
 * @property integer $investor_industry
 * @property string $investor_finance_amount
 * @property string $language_id
 * @property string $contact_address
 * @property string $contact_email
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Balance[] $balances
 * @property Banner[] $banners
 * @property Comment[] $comments
 * @property Favorite[] $favorites
 * @property Investor2Industry[] $investor2Industries
 * @property Investor2Project[] $investor2Projects
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property Project[] $projects
 * @property Country $investorCountry
 * @property Region $region
 * @property Media $logo
 * @property User2Region[] $user2Regions
 */
class User extends ActiveRecord
{
    public $password_repeat;
    public $old_password;

    const T_INITIATOR = 'initiator';
    const T_INVESTOR = 'investor';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'User';
    }

    static function getAutocompleteDrop()
    {
        $criteria = new CDbCriteria();
        $criteria->order='name';
        $criteria->addColumnCondition(array('t.is_active' => 1));
        $return = array();
        foreach(self::model()->findAll($criteria) as $user){
            $return[$user->id] = $user->login . ' ' . $user->name;
        }
        return $return;
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login, password,email', 'required'),
            array('name, region_id, contact_address, phone, post, fax, contact_email', 'required', 'on' => 'update'),
            array('investor_industry,is_active,is_subscribe', 'numerical', 'integerOnly' => true),
            array('investor_finance_amount', 'type', 'type' => 'float'),
            array('investor_type', 'length', 'max' => 5),
            array('password_repeat,password', 'length', 'min' => 5),
            array('email,login', 'unique'),
            array('email', 'email'),
            array('login, password, name, phone, post, fax, email, company_name, company_address, company_form, inn, ogrn', 'length', 'max' => 255),
            array('type', 'length', 'max' => 9),
            array('logo_id, region_id, investor_country_id, investor_finance_amount', 'length', 'max' => 10),
            array('company_description, company_scope,contact_address,contact_email,create_date', 'safe'),
            array('password, password_repeat', 'unsafe', 'on' => 'update'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, login, password, type, name, phone, post, fax, email, company_name, company_address, company_form, company_description, company_scope, inn, ogrn, logo_id, region_id', 'safe', 'on' => 'search'),
            array('password_repeat', 'compare', 'compareAttribute' => 'password', 'on' => 'signup,changePassword,changeByAdminPassword'),
            array('password_repeat', 'required', 'on' => 'signup,changePassword,changeByAdminPassword'),
            array('old_password', 'required', 'on' => 'changePassword'),
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
            'balances' => array(self::HAS_MANY, 'Balance', 'user_id'),
            'banners' => array(self::HAS_MANY, 'Banner', 'user_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
            'favorites' => array(self::HAS_MANY, 'Favorite', 'user_id'),
            'investor2Industries' => array(self::HAS_MANY, 'Investor2Industry', 'user_id'),
            'investor2Projects' => array(self::HAS_MANY, 'Investor2Project', 'user_id'),
            'messages' => array(self::HAS_MANY, 'Message', 'user_from'),
            'messages1' => array(self::HAS_MANY, 'Message', 'user_to'),
            'projects' => array(self::HAS_MANY, 'Project', 'user_id'),
            'investorCountry' => array(self::BELONGS_TO, 'Country', 'investor_country_id'),
            'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
            'logo' => array(self::BELONGS_TO, 'Media', 'logo_id'),
            'user2Regions' => array(self::HAS_MANY, 'User2Region', 'user_id'),
            'quotes' => array(self::HAS_MANY, 'User2Quote', 'user_id'),
            'projectViewers' => array(self::HAS_MANY, 'UserView', 'target_user_id', 'condition' => 'view_type = "project"'),
            'profileViewers' => array(self::HAS_MANY, 'UserView', 'target_user_id', 'condition' => 'view_type = "profile"'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => Yii::t('main', 'Логин'),
            'password' => Yii::t('main', 'Пароль'),
            'type' => Yii::t('main', 'Тип пользователя'),
            'name' => Yii::t('main', 'ФИО'),
            'phone' => Yii::t('main', 'Телефон'),
            'password_repeat' => Yii::t('main', 'Пароль повторно'),
            'post' => Yii::t('main', 'Должность'),
            'email' => Yii::t('main', 'E-mail'),
            'company_name' => Yii::t('main', 'Наименование'),
            'company_form' => Yii::t('main', 'Форма собственности'),
            'company_description' => Yii::t('main', 'Описание компании'),
            'company_scope' => Yii::t('main', 'Сфера деятельности'),
            'company_address' => Yii::t('main', 'Адрес компании'),
            'inn' => Yii::t('main', 'ИНН'),
            'ogrn' => Yii::t('main', 'ОГРН'),
            'logo_id' => Yii::t('main', 'Логотип'),
            'region_id' => Yii::t('main', 'Регион'),
            'fax' => 'Факс',
            'investor_country_id' => Yii::t('main', 'Страна'),
            'investor_type' => Yii::t('main', 'Тип инвестора'),
            'investor_industry' => Yii::t('main', 'Предпочтительные отрасли'),
            'investor_finance_amount' => Yii::t('main', 'Сумма финансирования (млн. руб.)'),
            'old_password' => Yii::t('main', 'Старый пароль'),
            'contact_email' => Yii::t('main', 'E-mail'),
            'contact_address' => Yii::t('main', 'Адрес'),
            'is_subscribe' => Yii::t('main', 'Получать рассылки iip.ru'),
        );
    }

    public function scopes()
    {
        return array(
            'active' => array(
                'condition' => 't.is_active = 1', #активные-живые пользователи
            ),
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

        $criteria->addColumnCondition(array('t.is_active' => 1));
        $criteria->compare('id', $this->id, true);
        $criteria->compare('login', $this->login, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('post', $this->post, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('company_address', $this->company_address, true);
        $criteria->compare('company_form', $this->company_form, true);
        $criteria->compare('company_description', $this->company_description, true);
        $criteria->compare('company_scope', $this->company_scope, true);
        $criteria->compare('inn', $this->inn, true);
        $criteria->compare('ogrn', $this->ogrn, true);
        $criteria->compare('logo_id', $this->logo_id, true);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('is_subscribe', $this->is_subscribe);

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
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getUserType()
    {
        return array('investor' => Yii::t('main', 'Инвестор'), 'initiator' => Yii::t('main', 'Инициатор'));
    }

    /**
     * По связи с media попробуем достучаться до аватара, если нет - вернем заглушку
     */
    public function getAvatar($scale = '50x50')
    {
        if (!isset($this->logo)) {

        } else {
            return Candy::preview(array($this->logo, 'scale' => $scale, 'scaleMode' => 'out'));
        }
    }

    /**
     * Вернуть последние проекты для виджета в меню
     */
    public function getApprovedProjects()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 't.create_date DESC';
        $criteria->addCondition('t.user_id = :user_id AND t.status="approved"');
        $criteria->params = array(':user_id' => $this->id);
        $criteria->with = 'logo';
        return Project::model()->findAll($criteria);
    }

    /**
     * Вернуть в нормальном виде имя
     */
    public function getName()
    {
        return $this->name;
    }

    public function hash()
    {
        return parent::hash();
    }

    /**
     * Войти в систеы под выбранным пользователем
     */
    public function autologin()
    {
        $identity = new UserIdentity($this->login, $this->password);
        $identity->authenticate();

        if ($identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = 3600 * 24 * 30; // 30 days
            Yii::app()->user->login($identity, $duration);
            Yii::app()->user->setState('__id', $this->id);
        }
    }

    /**
     * Сгенерировать новый пароль и залить его в модель
     * @param int $length
     */
    public function generatePassword($length = 7)
    {
        $chars = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($chars);
        $this->password = implode(array_slice($chars, 0, $length));
    }

    public function beforeValidate()
    {
        $this->investor_country_id = empty($this->investor_country_id) ? null : $this->investor_country_id;
        $this->investor_type = $this->investor_type < 0 ? null : $this->investor_type;
        $this->investor_industry = $this->investor_type < 0 ? null : $this->investor_industry;
        $this->investor_finance_amount = empty($this->investor_finance_amount) ? null : $this->investor_finance_amount;
        return parent::beforeValidate();
    }

    /**
     * Получить целевую аудиторию. В неё входят все активные юзеры (выбранные по критерии) и среднеарифмитическое количество гостей за неделю
     * @return int $count
     */
    public static function countTarget($post)
    {
        $count = 0;
        $criteria = new CDbCriteria();
        $criteria->with = array('user2Regions');
        $criteria->addInCondition('user2Regions.region_id',$post['banner2region']);
        $criteria->addInCondition('t.region_id', Candy::get($post['banner2region'], array()),'OR'); #регион
        $criteria->addInCondition('t.type', Candy::get($post['Banner']['usersShow'], array())); #тип
        if (in_array(User::T_INVESTOR,$post['Banner']['usersShow'])) {
            $investCriteria = new CDbCriteria();
            $investCriteria->addInCondition('t.investor_country_id',Candy::get($post['banner2country']));
            $investCriteria->addInCondition('t.investor_industry',Candy::get($post['banner2industry']));
            $investCriteria->addInCondition('t.investor_type',Candy::get($post['banner2investorType']));
            $investCriteria->addCondition('t.type = "investor" AND t.investor_finance_amount >= :amount');
            $investCriteria->params += array(':amount' => Candy::get($post['Banner']['investor_amount']));
            $criteria->mergeWith($investCriteria,'OR');
        }
        $criteria->addCondition('t.id != :currentId');
        $criteria->params += array(':currentId'=>Yii::app()->user->id); #не забудем себя убрать
        $count += self::model()->active()->count($criteria); #зарегестрированные- пользователи
        $sevenDayAgo = Candy::formatDate(Candy::date_plus(null, '- 7 days'), Candy::DATE);
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.region_id',$post['banner2region']);
        $criteria->addCondition('date >= :date AND date <= DATE(NOW())');
        $criteria->params += array(':date' => $sevenDayAgo);

        $directCount = ceil(Direct::model()->count($criteria) / 7);
        $count += $directCount;
        return $count;
    }

    /**
     * Понять имеется ли у переданного пользователя общие проекты с текущим
     * @param $userId
     * @return bool
     */
    public function hasJointProject($userId){
        if($userId == $this->id) //для себя родимого - сразу true
            return true;
        if(is_null($userId)) //для гостя - всегда непропускаем
            return false;
        $criteria = new CDbCriteria();
        $criteria->with = array('project');
        $criteria->addCondition('project.user_id = :user_id AND t.is_active = 1 AND t.user_id = :current_user');
        $criteria->params += array(':user_id'=>$this->id,':current_user'=>$userId);
        return Investor2Project::model()->count($criteria);
    }

    public function profileCompletion()
    {
        $attr = array(
            'name',
            'phone',
            'post',
            'fax',
            'email',
            'company_name',
            'company_address',
            'company_form',
            'inn',
            'ogrn',
            'logo_id',
            'region_id',
            'contact_address',
            'contact_email',
        );
        $empty = 0;
        foreach ($attr as $item) {
            if (empty($this->{$item})) {
                $empty++;
            }
        }
        return floor((count($attr) - $empty) / count($attr) * 100);
    }

    public function getFavoritesList($attr){
        $array = array();
        foreach($this->favorites as $fav){
            if(!empty($fav->{$attr})){
                $array[] = $fav->{$attr};
            }
        }
        return $array;
    }

    public function getProjectViews()
    {
        $sum = Yii::app()->db->createCommand("SELECT SUM(view_count) as view_count FROM Project WHERE user_id = {$this->id}")->queryScalar();
        return $sum ? $sum : 0;
    }

    public function getProjectReply()
    {
        $sum = Yii::app()->db->createCommand("SELECT SUM(reply_count) as reply_count FROM Project WHERE user_id = {$this->id}")->queryScalar();
        return $sum ? $sum : 0;
    }

    public function getUrl()
    {
        if ($this->type == 'investor') {
            return '/investor/view/id/' . $this->id;
        } else {
            return '/project/iniciator/id/' . $this->id;
        }
    }
}