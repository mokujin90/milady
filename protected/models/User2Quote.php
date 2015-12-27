<?php

/**
 * This is the model class for table "User2Quote".
 *
 * The followings are the available columns in table 'User2Quote':
 * @property string $id
 * @property string $user_id
 * @property string $quote
 *
 * The followings are the available model relations:
 * @property User $user
 */
class User2Quote extends CActiveRecord
{
    static public $quotes = array(
        'USD' =>
        array(
            'name' => 'Динамика курса USD ЦБ РФ, руб.',
            'url' => 'https://news.yandex.ru/quotes/graph_1.xml&lang=ru&_=838917'
        ),
        'EUR' =>
        array(
            'name' => 'Динамика курса EUR ЦБ РФ, руб.',
            'url' => 'https://news.yandex.ru/quotes/graph_23.xml&lang=ru&_=750149'
        ),
        'Brent' =>
        array(
            'name' => 'Динамика цен на Нефть Brent (ICE.Brent), USD/баррель',
            'url' => 'https://news.yandex.ru/quotes/graph_1006.xml&lang=ru&_=593330'
        ),
        'MMVB' =>
        array(
            'name' => 'Динамика индекса ММВБ',
            'url' => 'https://news.yandex.ru/quotes/graph_1013.xml&lang=ru&_=805576'
        ),
        'Nikkei225' =>
        array(
            'name' => 'Динамика индекса Nikkei 225',
            'url' => 'https://news.yandex.ru/quotes/graph_2505.xml&lang=ru&_=543908'
        ),
        'S&P500' =>
        array(
            'name' => 'Динамика индекса S&P 500',
            'url' => 'https://news.yandex.ru/quotes/graph_2506.xml&lang=ru&_=063918'
        ),
        'DJIA' =>
        array(
            'name' => 'Динамика индекса Dow (DJIA)',
            'url' => 'https://news.yandex.ru/quotes/graph_12.xml&lang=ru&_=466775'
        ),
        'NASDAQ' =>
        array(
            'name' => 'Динамика индекса NASDAQ',
            'url' => 'https://news.yandex.ru/quotes/graph_17.xml&lang=ru&_=439927'
        ),
        'FTSE100' =>
        array(
            'name' => 'Динамика индекса FTSE 100',
            'url' => 'https://news.yandex.ru/quotes/graph_13.xml&lang=ru&_=050554'
        ),
        'HangSeng' =>
        array(
            'name' => 'Динамика индекса Hang Seng',
            'url' => 'https://news.yandex.ru/quotes/graph_1007.xml&lang=ru&_=457389'
        ),
    );
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'User2Quote';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'length', 'max'=>10),
            array('quote', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, quote', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'quote' => 'Quote',
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
        $criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('quote',$this->quote,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User2Quote the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}