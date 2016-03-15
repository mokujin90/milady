<?php

/**
 * This is the model class for table "investment_projects".
 *
 * The followings are the available columns in table 'investment_projects':
 * @property integer $id
 * @property string $companyName
 * @property string $companyAddress
 * @property string $companyDesc
 * @property string $companyScope
 * @property string $finance
 * @property string $cAddress
 * @property string $contact
 * @property string $post
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $ruName
 * @property string $engName
 * @property string $shortDesc
 * @property string $place
 * @property string $industry
 * @property string $obshayaSum
 * @property string $polnayaSum
 * @property string $formaInvestment
 * @property string $sumInvestment
 * @property string $useInvestment
 * @property string $mainTermsFinance
 * @property string $termsFinance
 * @property string $stageProject
 * @property string $kapConstruction
 * @property string $oborydovanie
 * @property string $products
 * @property string $maxProducts
 * @property string $finRevenue
 * @property string $finCleanRevenue
 * @property string $finRentabl
 * @property double $finSrok
 * @property double $finCleanDohod
 * @property double $finNormaDohod
 * @property string $finGarantii
 * @property integer $moderated
 * @property integer $onmain
 * @property string $photo
 * @property string $file
 * @property string $fileName
 * @property integer $approval
 * @property string $address
 * @property integer $idAuthor
 */
class ImportInvestmentProjects extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'investment_projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyName, companyAddress, companyDesc, companyScope, finance, cAddress, contact, post, phone, fax, email, ruName, engName, shortDesc, place, industry, obshayaSum, polnayaSum, formaInvestment, sumInvestment, useInvestment, mainTermsFinance, termsFinance, stageProject, kapConstruction, oborydovanie, products, maxProducts, finRevenue, finCleanRevenue, finRentabl, finSrok, finCleanDohod, finNormaDohod, finGarantii, moderated, photo, file, fileName, address', 'required'),
			array('moderated, onmain, approval, idAuthor', 'numerical', 'integerOnly'=>true),
			array('finSrok, finCleanDohod, finNormaDohod', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, companyName, companyAddress, companyDesc, companyScope, finance, cAddress, contact, post, phone, fax, email, ruName, engName, shortDesc, place, industry, obshayaSum, polnayaSum, formaInvestment, sumInvestment, useInvestment, mainTermsFinance, termsFinance, stageProject, kapConstruction, oborydovanie, products, maxProducts, finRevenue, finCleanRevenue, finRentabl, finSrok, finCleanDohod, finNormaDohod, finGarantii, moderated, onmain, photo, file, fileName, approval, address, idAuthor', 'safe', 'on'=>'search'),
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
			'companyName' => 'Company Name',
			'companyAddress' => 'Company Address',
			'companyDesc' => 'Company Desc',
			'companyScope' => 'Company Scope',
			'finance' => 'Finance',
			'cAddress' => 'C Address',
			'contact' => 'Contact',
			'post' => 'Post',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'email' => 'Email',
			'ruName' => 'Ru Name',
			'engName' => 'Eng Name',
			'shortDesc' => 'Short Desc',
			'place' => 'Place',
			'industry' => 'Industry',
			'obshayaSum' => 'Obshaya Sum',
			'polnayaSum' => 'Polnaya Sum',
			'formaInvestment' => 'Forma Investment',
			'sumInvestment' => 'Sum Investment',
			'useInvestment' => 'Use Investment',
			'mainTermsFinance' => 'Main Terms Finance',
			'termsFinance' => 'Terms Finance',
			'stageProject' => 'Stage Project',
			'kapConstruction' => 'Kap Construction',
			'oborydovanie' => 'Oborydovanie',
			'products' => 'Products',
			'maxProducts' => 'Max Products',
			'finRevenue' => 'Fin Revenue',
			'finCleanRevenue' => 'Fin Clean Revenue',
			'finRentabl' => 'Fin Rentabl',
			'finSrok' => 'Fin Srok',
			'finCleanDohod' => 'Fin Clean Dohod',
			'finNormaDohod' => 'Fin Norma Dohod',
			'finGarantii' => 'Fin Garantii',
			'moderated' => 'Moderated',
			'onmain' => 'Onmain',
			'photo' => 'Photo',
			'file' => 'File',
			'fileName' => 'File Name',
			'approval' => 'Approval',
			'address' => 'Address',
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
		$criteria->compare('companyName',$this->companyName,true);
		$criteria->compare('companyAddress',$this->companyAddress,true);
		$criteria->compare('companyDesc',$this->companyDesc,true);
		$criteria->compare('companyScope',$this->companyScope,true);
		$criteria->compare('finance',$this->finance,true);
		$criteria->compare('cAddress',$this->cAddress,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('ruName',$this->ruName,true);
		$criteria->compare('engName',$this->engName,true);
		$criteria->compare('shortDesc',$this->shortDesc,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('obshayaSum',$this->obshayaSum,true);
		$criteria->compare('polnayaSum',$this->polnayaSum,true);
		$criteria->compare('formaInvestment',$this->formaInvestment,true);
		$criteria->compare('sumInvestment',$this->sumInvestment,true);
		$criteria->compare('useInvestment',$this->useInvestment,true);
		$criteria->compare('mainTermsFinance',$this->mainTermsFinance,true);
		$criteria->compare('termsFinance',$this->termsFinance,true);
		$criteria->compare('stageProject',$this->stageProject,true);
		$criteria->compare('kapConstruction',$this->kapConstruction,true);
		$criteria->compare('oborydovanie',$this->oborydovanie,true);
		$criteria->compare('products',$this->products,true);
		$criteria->compare('maxProducts',$this->maxProducts,true);
		$criteria->compare('finRevenue',$this->finRevenue,true);
		$criteria->compare('finCleanRevenue',$this->finCleanRevenue,true);
		$criteria->compare('finRentabl',$this->finRentabl,true);
		$criteria->compare('finSrok',$this->finSrok);
		$criteria->compare('finCleanDohod',$this->finCleanDohod);
		$criteria->compare('finNormaDohod',$this->finNormaDohod);
		$criteria->compare('finGarantii',$this->finGarantii,true);
		$criteria->compare('moderated',$this->moderated);
		$criteria->compare('onmain',$this->onmain);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('fileName',$this->fileName,true);
		$criteria->compare('approval',$this->approval);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('idAuthor',$this->idAuthor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImportInvestmentProjects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
