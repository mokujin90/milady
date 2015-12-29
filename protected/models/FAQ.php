<?php

/**
 * This is the model class for table "FAQ".
 *
 * The followings are the available columns in table 'FAQ':
 * @property string $id
 * @property string $question
 * @property string $answer
 * @property string $parent_id
 *
 * The followings are the available model relations:
 * @property FAQ $parent
 * @property FAQ[] $fAQs
 */
class FAQ extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'FAQ';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('question, answer', 'required'),
            array('parent_id', 'length', 'max'=>10),
            array('answer', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, question, answer, parent_id', 'safe', 'on'=>'search'),
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
            'parent' => array(self::BELONGS_TO, 'FAQ', 'parent_id'),
            'fAQs' => array(self::HAS_MANY, 'FAQ', 'parent_id'),
        );
    }

    protected function beforeSave(){
        if(parent::beforeSave())
        {
            $this->parent_id = empty($this->parent_id) ? NULL : $this->parent_id;
            return true;
        }
        return false;
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'question' => 'Вопрос',
            'answer' => 'Ответ',
            'parent_id' => 'Родительский вопрос',
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
        $criteria->compare('question',$this->question,true);
        $criteria->compare('answer',$this->answer,true);
        $criteria->compare('parent_id',$this->parent_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FAQ the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}