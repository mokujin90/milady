<?
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScriptFile('/js/vendor/ion.rangeSlider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('/css/vendor/ion.rangeSlider.css');
?>
<div class="content columns no-transform full-form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter',
        'action'=>$this->createUrl(''),
        'method'=>'get',
        'htmlOptions'=>array('class'=>'opacity-box form filter-form'
        ))); ?>
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
            <?$this->widget('crud.dropDownList',
                array('model'=>$filter, 'attribute'=>'placeList','elements'=>Region::getDrop() ));?>
        </div>
        <div class="field drop">
            <?$this->widget('crud.dropDownList',
                array('model'=>$filter, 'attribute'=>'objectList','elements'=>$filter::$objectDrop));?>
        </div>
    </div>
    <div class="row">
        <div class="field drop">
            <?$this->widget('crud.dropDownList',
                array('model'=>$filter, 'attribute'=>'investmentFormList','elements'=>$filter::$investmentFormDrop));?>
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
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'investmentList','elements'=>$filter::$objectDrop));?>
            </div>

            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInnovative')?>
                <?= $form->label($filter,'isInnovative')?>
            </div>
            <div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'innovativeList','elements'=>$filter::$objectDrop));?>
            </div>

            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isBusinessSale')?>
                <?= $form->label($filter,'isBusinessSale')?>
            </div>
            <div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'businessSaleList','elements'=>$filter::$objectDrop));?>
            </div>

            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isBusinessRental')?>
                <?= $form->label($filter,'isBusinessRental')?>
            </div>
            <div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'businessRentalList','elements'=>$filter::$objectDrop));?>
            </div>
        </div>

        <div class="element">
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isCritical')?>
                <?= $form->label($filter,'isCritical')?>
            </div>
            <div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'criticalList','elements'=>$filter::$objectDrop));?>
            </div>

            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInfrastructure')?>
                <?= $form->label($filter,'isInfrastructure')?>
            </div>
            <div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'infrastructureList','elements'=>$filter::$objectDrop));?>
            </div>

            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInvestPlatform')?>
                <?= $form->label($filter,'isInvestPlatform')?>
            </div>
            <div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'investPlatformList','elements'=>$filter::$objectDrop));?>
            </div>

            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInvestForm')?>
                <?= $form->label($filter,'isInvestForm')?>
            </div>
            <div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'investFormList','elements'=>$filter::$objectDrop));?>
            </div>
        </div>
    </div>
    <?php echo CHtml::submitButton('1')?>
    <?php $this->endWidget(); ?>
</div>

<div class="dark-gray-gradient line top bottom">
    <div class="main short-form">

    </div>
</div>