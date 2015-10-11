<?php

/**
 * This is the model class for table "Deal".
 *
 * The followings are the available columns in table 'Deal':
 * @property string $id
 * @property string $dialog_id
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Dialog $dialog
 */
class Deal extends CActiveRecord
{
    public static $form = array(
        'pending' => array(
            'text' => 'No deal created.',
            'action' => array(
                'on_open_deal' => 'Open Deal',
            )
        ),
        'on_open' => array(
            'text' => 'Confirm new deal?',
            'action' => array(
                'open_deal' => 'Yes',
                'remove_deal' => 'No'
            )
        ),
        'open' => array(
            'text' => 'Deal is active.',
            'action' => array(
                'on_close_deal' => 'Close deal',
            )
        ),
        'on_close' => array(
            'text' => 'Confirm close deal?',
            'action' => array(
                'close_deal' => 'Yes',
                'open_deal' => 'No'
            )
        ),
        'close' => array(
            'text' => 'Deal closed.',
            'action' => array()
        ),
    );
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Deal';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dialog_id', 'length', 'max'=>10),
            array('status', 'length', 'max'=>8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, dialog_id, status', 'safe', 'on'=>'search'),
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
            'dialog' => array(self::BELONGS_TO, 'Dialog', 'dialog_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'dialog_id' => 'Dialog',
            'status' => 'Status',
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
        $criteria->compare('dialog_id',$this->dialog_id,true);
        $criteria->compare('status',$this->status,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Deal the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}