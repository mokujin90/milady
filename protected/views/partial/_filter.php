<?
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScriptFile('/js/vendor/ion.rangeSlider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('/css/vendor/ion.rangeSlider.css');
?>
<div class="content columns no-transform">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter',
        'method' => 'get',
        'htmlOptions'=>array('class'=>'opacity-box form filter-form'))
    ); ?>
    <h2><?=$filter::$filter?></h2>
    <h3><?= Yii::t('main','Тип площадок')?></h3>

    <div class="row">
        <div class="field margin-9">
            <?= $form->label($filter,'name',array('class'=>'up block'))?>
            <?= $form->textField($filter,'name',array('class'=>'crud'))?>
        </div>
        <div class="field margin-2">
            <?= $form->label($filter,'projectName',array('class'=>'up block'))?>
            <?= $form->textField($filter,'projectName',array('class'=>'crud'))?>
        </div>
        <div class="field">
            <?= Crud::activeRadioButtonList($filter,'viewType',$filter::$viewTypeDrop,array('separator'=>''))?>
        </div>
    </div>
    <div class="row">
        <div class="field margin-6 drop">
            <?= $form->label($filter,'placeList',array('class'=>'up drop-label'))?>
            <?$this->widget('crud.dropDownList',
                array('model'=>$filter, 'attribute'=>'placeList','elements'=>CHtml::listData(Region::model()->findAll(), 'id' , 'name')));?>
        </div>
        <div class="field drop">
            <?= $form->label($filter,'objectList',array('class'=>'up drop-label'))?>
            <?$this->widget('crud.dropDownList',
                array('model'=>$filter, 'attribute'=>'objectList','elements'=>Project::getObjectTypeDrop()));?>
        </div>
    </div>
    <div class="row">
        <div class="field range">
            <?= $form->label($filter,'payback')?>
            <?= Crud::activeRange($filter,'payback',$filter::$paybackParam);?>
        </div>
        <div class="field range">
            <?= $form->label($filter,'profit')?>
            <?= Crud::activeRange($filter,'profit',$filter::$profitParam);?>
        </div>
        <div class="field range">
            <?= $form->label($filter,'investSum')?>
            <?= Crud::activeRange($filter,'investSum',$filter::$investSumParam);?>
        </div>
        <div class="field range">
            <?= $form->label($filter,'returnRate')?>
            <?= Crud::activeRange($filter,'returnRate',$filter::$returnRateParam);?>
        </div>
    </div>
    <div class="row">
        <div class="element">
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInvestment')?>
                <?= $form->label($filter,'isInvestment')?>
            </div>
            <div class="field switcher-child drop">
                <?= $form->label($filter,'investmentList',array('class'=>'up drop-label'))?>
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'investmentList','elements'=>Project::getIndustryTypeDrop()));?>
                <br><br>
                <?= $form->label($filter,'investmentFormList',array('class'=>'up drop-label'))?>
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'investmentFormList','elements'=>InvestmentProject::getInvestmentFormDrop()));?>
            </div>
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInnovative')?>
                <?= $form->label($filter,'isInnovative')?>
            </div>
            <div class="field switcher-child drop">
                <?= $form->label($filter,'innovativeList',array('class'=>'up drop-label'))?>
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'innovativeList','elements'=>Project::getProjectStepDrop()));?>
                <br><br>
                <?= $form->label($filter,'criticalList',array('class'=>'up drop-label'))?>
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'criticalList','elements'=>InnovativeProject::getRelevanceTypeDrop()));?>
            </div>
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isBusinessSale')?>
                <?= $form->label($filter,'isBusinessSale')?>
            </div>
            <!--div class="field switcher-child drop"></div-->
        </div>

        <div class="element">
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInfrastructure')?>
                <?= $form->label($filter,'isInfrastructure')?>
            </div>
            <div class="field switcher-child drop">
                <?= $form->label($filter,'infrastructureList',array('class'=>'up drop-label'))?>
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'infrastructureList','elements'=>InfrastructureProject::getTypeDrop()  ));?>
            </div>
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInvestPlatform')?>
                <?= $form->label($filter,'isInvestPlatform')?>
            </div>
            <!--div class="field switcher-child drop"></div-->
        </div>
        <div class="button-panel center">
            <?=CHtml::submitButton(Yii::t('main','Найти'),array('class'=>'btn'))?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<div class="dark-gray-gradient line top bottom">
    <div class="main">

    </div>
</div>