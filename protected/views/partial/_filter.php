<?
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScriptFile('/js/vendor/ion.rangeSlider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('/css/vendor/ion.rangeSlider.css');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter',
    'action'=> !empty($_GET['map']) ? $this->createUrl('project/map') : $this->createUrl('project/index'),
    'method'=>'get',
    'htmlOptions'=>array('class'=>'opacity-box form filter-form'
    ))); ?>
<?= $form->textField($filter,'name',array('class'=>'filter__field', 'placeholder' => $filter->getAttributeLabel('name')))?>
<?= $form->textField($filter,'projectName',array('class'=>'filter__field', 'placeholder' => $filter->getAttributeLabel('projectName')))?>

<?=$form->hiddenField($filter,'extendedFilter', array('id' => 'extended-filter'))?>
<? //Crud::activeRadioButtonList($filter,'viewType',$filter::$viewTypeDrop,array('separator'=>''))?>
<?$this->widget('crud.dropDownList',
    array('model'=>$filter, 'attribute'=>'placeList','elements'=>Region::getDrop()));?>

<div class="p-filter-add <?=$filter->extendedFilter? 'open': ''?>" >
    <?$this->widget('crud.dropDownList',
        array('model'=>$filter, 'attribute'=>'industryList','elements'=>Project::getIndustryTypeDrop(), 'htmlOptions' => array('class' => 'extend')));?>

    <div class="field range">
        <?= $form->label($filter,'investSum')?>
        <?= Crud::activeRange($filter,'investSum',$filter::$investSumParam, array('class' => 'extend'));?>
    </div>
    <div class="field range">
        <?= $form->label($filter,'payback')?>
        <?= Crud::activeRange($filter,'payback',$filter::$paybackParam, array('class' => 'extend'));?>
    </div>
    <div class="field range">
        <?= $form->label($filter,'profit')?>
        <?= Crud::activeRange($filter,'profit',$filter::$profitParam, array('class' => 'extend'));?>
    </div>

    <div class="field range">
        <?= $form->label($filter,'returnRate')?>
        <?= Crud::activeRange($filter,'returnRate',$filter::$returnRateParam, array('class' => 'extend'));?>
    </div>

    <!--div class="field switcher-parent">
        <?= Crud::activeCheckBox($filter,'isInvestment',array('uncheckValue' => 0))?>
        <?= $form->label($filter,'isInvestment')?>
    </div>

    <div class="field switcher-child drop">
        <?$this->widget('crud.dropDownList',
            array('model'=>$filter, 'attribute'=>'investmentFormList','elements'=>Project::getFinanceTypeDrop(), 'htmlOptions' => array('class' => 'extend')));?>
    </div>

    <div class="field switcher-parent">
        <?= Crud::activeCheckBox($filter,'isInnovative',array('uncheckValue' => 0))?>
        <?= $form->label($filter,'isInnovative')?>
    </div>

    <div class="field switcher-child drop">
        <div class="field range">
            <?= $form->label($filter,'innoPrice')?>
            <?= Crud::activeRange($filter,'innoPrice',$filter::$innoPriceParam, array('class' => 'extend'));?>
        </div>

        <?$this->widget('crud.dropDownList',
            array('model'=>$filter, 'attribute'=>'innovativeList','elements'=>Project::getProjectStepDrop(), 'htmlOptions' => array('class' => 'extend')));?>

        <?$this->widget('crud.dropDownList',
            array('model'=>$filter, 'attribute'=>'criticalList','elements'=>InnovativeProject::getRelevanceTypeDrop(), 'htmlOptions' => array('class' => 'extend')));?>

        <?$this->widget('crud.dropDownList',
            array('model'=>$filter, 'attribute'=>'innovativeFormList','elements'=>Project::getFinanceTypeDrop(), 'htmlOptions' => array('class' => 'extend')));?>
    </div>

    <div class="field switcher-parent">
        <?= Crud::activeCheckBox($filter,'isInfrastructure',array('uncheckValue' => 0))?>
        <?= $form->label($filter,'isInfrastructure')?>
    </div>

    <div class="field switcher-parent">
        <?= Crud::activeCheckBox($filter,'isBusinessSale',array('uncheckValue' => 0))?>
        <?= $form->label($filter,'isBusinessSale')?>
    </div>

    <div class="field switcher-child drop">
        <div class="field range">
            <?= $form->label($filter,'busPrice')?>
            <?= Crud::activeRange($filter,'busPrice',$filter::$busPriceParam, array('class' => 'extend'));?>
        </div>
        <div class="field range">
            <?= $form->label($filter,'busPart')?>
            <?= Crud::activeRange($filter,'busPart',$filter::$busPartParam, array('class' => 'extend'));?>
        </div>
    </div>

    <div class="field switcher-parent">
        <?= Crud::activeCheckBox($filter,'isInvestPlatform',array('uncheckValue' => 0))?>
        <?= $form->label($filter,'isInvestPlatform')?>
    </div>

    <div class="field switcher-child drop">
        <div class="field range">
            <?= $form->label($filter,'siteSquare')?>
            <?= Crud::activeRange($filter,'siteSquare',$filter::$siteSquareParam, array('class' => 'extend'));?>
        </div>
        <?$this->widget('crud.dropDownList',
            array('model'=>$filter, 'attribute'=>'locationList','elements'=>InvestmentSite::getLocationTypeDrop(), 'htmlOptions' => array('class' => 'extend')));?>
    </div-->
</div>
<p class="filter__selected">
    <span class="filter__selected_length"><?=Candy::getNumEnding($filter->selectedCount, array(Yii::t('main', 'Выбран'),  Yii::t('main', 'Выбрано'),  Yii::t('main', 'Выбрано')))?> <?=$filter->selectedCount?> <?=Candy::getNumEnding($filter->selectedCount, array(Yii::t('main', 'проект'),  Yii::t('main', 'проекта'),  Yii::t('main', 'проектов')))?></span> из
    <span class="filter__selected_all"><?=number_format(Project::model()->countByAttributes(array('status' => 'approved', 'is_disable' => 0, 'type' => 1)),0 ,',', ' ')?></span>
</p>
<?if(empty($ajax)) {
    echo CHtml::submitButton(Yii::t('main', 'НАЙТИ'), array('class' => 'blue-btn full-width'));
} else {
    echo CHtml::ajaxSubmitButton(Yii::t('main', 'НАЙТИ'), CHtml::normalizeUrl(array('')),
        array(
            'dataType' => 'json',
            'type' => 'post',
            'success' => 'function(data)
            {
                $("#filter-action").removeClass("disabled").prop("disabled", false);
                if(data.success == true){
                    mapJs.markersCluster.clearLayers();
                    $.each(data.data, function(){
                         mapJs.addBalloon({
                            extendAjaxPopup:1,
                            lat:this.lat,
                            lon:this.lon,
                            draggable:0,
                            icon:this.icon,
                            search:0,
                            id:this.id,
                            cluster:1,
                            ajaxBalloon:1
                        });
                    });
                    $(".filter__selected_length").text(data.count_text);
                }
        }'
        ), array('onclick' => '$(this).addClass("disabled").prop("disabled", true);', 'class' => 'blue-btn full-width', 'id' => 'filter-action'));
}
?>

<div class="p-filter-block__add p-filter-block__add_map <?=$filter->extendedFilter? 'open': ''?>">
    <span><?=$filter->extendedFilter? Yii::t('main', 'Свернуть фильтр'): Yii::t('main', 'Подробный фильтр')?></span>
</div>
<?php $this->endWidget(); ?>
