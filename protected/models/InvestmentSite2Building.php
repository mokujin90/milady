<?php

/**
 * This is the model class for table "InvestmentSite2Building".
 *
 * The followings are the available columns in table 'InvestmentSite2Building':
 * @property string $id
 * @property string $site_id
 * @property string $name
 * @property string $area
 * @property integer $level
 * @property string $height
 * @property string $material
 * @property string $status
 * @property string $character
 * @property string $expansion
 *
 * The followings are the available model relations:
 * @property InvestmentSite $site
 */
class InvestmentSite2Building extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'InvestmentSite2Building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_id', 'required'),
			array('level', 'numerical', 'integerOnly'=>true),
			array('site_id', 'length', 'max'=>10),
			array('material, status, character, expansion', 'length', 'max'=>255, 'tooLong' => "Поле  «{attribute}» слишком длинное."),
			array('name, area, height', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, site_id, name, area, level, height, material, status, character, expansion', 'safe', 'on'=>'search'),
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
			'site' => array(self::BELONGS_TO, 'InvestmentSite', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main','ID'),
			'site_id' => Yii::t('main','Site'),
			'name' => Yii::t('main','Наименование здания, сооружения'),
			'area' => Yii::t('main','Площадь (кв.м)'),
			'level' => Yii::t('main','Этажность'),
			'height' => Yii::t('main','Высота потолков (м.)'),
			'material' => Yii::t('main','Строительный материал'),
			'status' => Yii::t('main','Состояние'),
			'character' => Yii::t('main','Характер предыдущей деятельности'),
			'expansion' => Yii::t('main','Возможность расширения'),
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
		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('character',$this->character,true);
		$criteria->compare('expansion',$this->expansion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestmentSite2Building the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getHeader(){
        $labels = self::model()->attributeLabels();
        unset($labels['id'],  $labels['site_id']);
        return $labels;
    }
}
