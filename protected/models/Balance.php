<?php

/**
 * This is the model class for table "Balance".
 *
 * The followings are the available columns in table 'Balance':
 * @property string $id
 * @property string $user_id
 * @property string $value
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Balance extends CActiveRecord
{
    const T_ADD = 'add';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Balance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'required'),
            array('user_id, value', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, value', 'safe', 'on' => 'search'),
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
            'value' => 'Value',
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
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('value', $this->value, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Balance the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function get($userId)
    {
        $model = self::model()->findByAttributes(array('user_id' => $userId));
        if ($model) {
            return $model;
        }
        $model = new self;
        $model->user_id = $userId;
        $model->save();
        return $model;
    }

    /**
     * Выполнить платеж/пополнить счет
     * @param $userId
     * @param $cost
     * @param $type
     * @param string $description
     * @return bool
     */
    public static function pay($userId, $cost, $type, $description = '')
    {
        $model = self::get($userId);
        $startBalance = $model->value;
        if($type==Balance::T_ADD){
            $model->value += $cost;
        }
        else{
            if ($model->value < $cost) {
                return false;
            }
            $model->value -= $cost;
            if ($model->value < 0) {
                $model->value = 0;
            }
        }
        if($model->save()){
            $history = new BalanceHistory();
            $history->user_id = $userId;
            $history->balance_in = $startBalance;
            $history->balance_out = $model->value;
            $history->delta = $history->balance_out - $history->balance_in;
            $history->object_type = $type;
            $history->description = $description;
            $history->save();
            return true;
        }
    }
}
