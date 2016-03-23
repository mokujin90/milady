<?php

/**
 * This is the model class for table "investors".
 *
 * The followings are the available columns in table 'investors':
 * @property integer $id
 * @property string $ruName
 * @property string $engName
 * @property string $partner
 * @property string $address
 * @property string $contact
 * @property string $post
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $web
 * @property string $shortDesc
 * @property string $country
 * @property string $type
 * @property integer $sum
 * @property string $industry
 * @property string $other
 * @property integer $moderated
 * @property integer $onmain
 * @property string $photo
 * @property integer $idAuthor
 */
class Investors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'investors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ruName, engName, partner, address, contact, post, phone, fax, email, web, shortDesc, country, type, sum, industry, other, moderated, photo', 'required'),
			array('sum, moderated, onmain, idAuthor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ruName, engName, partner, address, contact, post, phone, fax, email, web, shortDesc, country, type, sum, industry, other, moderated, onmain, photo, idAuthor', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ruName' => 'Ru Name',
			'engName' => 'Eng Name',
			'partner' => 'Partner',
			'address' => 'Address',
			'contact' => 'Contact',
			'post' => 'Post',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'email' => 'Email',
			'web' => 'Web',
			'shortDesc' => 'Short Desc',
			'country' => 'Country',
			'type' => 'Type',
			'sum' => 'Sum',
			'industry' => 'Industry',
			'other' => 'Other',
			'moderated' => 'Moderated',
			'onmain' => 'Onmain',
			'photo' => 'Photo',
			'idAuthor' => 'Id Author',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ruName',$this->ruName,true);
		$criteria->compare('engName',$this->engName,true);
		$criteria->compare('partner',$this->partner,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('shortDesc',$this->shortDesc,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('sum',$this->sum);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('moderated',$this->moderated);
		$criteria->compare('onmain',$this->onmain);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('idAuthor',$this->idAuthor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Investors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
