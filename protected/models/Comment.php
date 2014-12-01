<?php

/**
 * This is the model class for table "Comment".
 *
 * The followings are the available columns in table 'Comment':
 * @property string $id
 * @property string $type
 * @property string $user_id
 * @property string $text
 * @property string $create_date
 * @property string $parent_id
 * @property string object_id
 *
 * The followings are the available model relations:
 * @property Comment $parent
 * @property Comment[] $comments
 * @property User $user
 */
class Comment extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, user_id, create_date,object_id', 'required'),
            array('type', 'length', 'max' => 7),
            array('user_id, parent_id', 'length', 'max' => 10),
            array('text,object_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, user_id, text, create_date, parent_id', 'safe', 'on' => 'search'),
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
            'parent' => array(self::BELONGS_TO, 'Comment', 'parent_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'parent_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'child' => array(self::HAS_MANY, 'Comment', 'parent_id') //релейшн не для вызова в with
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'user_id' => 'User',
            'text' => 'Text',
            'create_date' => 'Create Date',
            'parent_id' => 'Parent',
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
        $criteria->compare('type', $this->type, true);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('parent_id', $this->parent_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Обертка для критерии, которая вернет нужные комментарии из общего списка
     * @param $id
     * @param string $type
     * @return Comment[]
     */
    public static function findCommentByObjectId($id, $type = self::DEFAULT_OBJECT)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('t.object_id' => $id, 't.type' => $type));
        $criteria->order = 't.create_date ASC'; #по возрастанию. Самые ранние ответы в начале
        $criteria->together = true;
        $criteria->with = array('user.logo'); #имена наших пользователей с изображениями
        $criteria->index = 'id';
        return self::model()->findAll($criteria);
    }

    public function afterSave()
    {
        if($this->isNewRecord){
            if($project = Project::model()->findByPk($this->object_id)){
                Message::sendSystemMessage($project->user_id, "Новый комментарий к проекту {$project->name}",  $this->text);
            }
        }
        parent::afterSave();
    }
}
