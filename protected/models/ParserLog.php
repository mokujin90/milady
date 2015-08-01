<?php

/**
 * This is the model class for table "ParserLog".
 *
 * The followings are the available columns in table 'ParserLog':
 * @property string $id
 * @property string $parser_id
 * @property string $datetime
 * @property integer $success
 *
 * The followings are the available model relations:
 * @property ParseNews $parser
 */
class ParserLog extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ParserLog';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('success', 'numerical', 'integerOnly'=>true),
            array('parser_id,parsed_count', 'length', 'max'=>10),
            array('datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, parser_id, datetime, success,parsed_count', 'safe', 'on'=>'search'),
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
            'parser' => array(self::BELONGS_TO, 'ParseNews', 'parser_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parser_id' => 'Регион',
            'datetime' => 'Время',
            'success' => 'Успешно',
            'parsed_count' => 'Добавлено новостей',
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
        $criteria->compare('parser_id',$this->parser_id,true);
        $criteria->compare('datetime',$this->datetime,true);
        $criteria->compare('success',$this->success);
        $criteria->compare('parsed_count',$this->parsed_count);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'datetime DESC',
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ParserLog the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}