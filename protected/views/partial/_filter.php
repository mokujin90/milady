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
    <br>
    <?=$form->hiddenField($filter,'extendedFilter', array('id' => 'extended-filter'))?>
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
                array('model'=>$filter, 'attribute'=>'placeList','elements'=>Region::getDrop()));?>
        </div>
        <div class="field drop">
            <?$this->widget('crud.dropDownList',
                array('model'=>$filter, 'attribute'=>'industryList','elements'=>Project::getIndustryTypeDrop()));?>
        </div>
    </div>
    <div class="row">
        <div class="field range <?=$filter->extendedFilter? '': 'hidden-filter'?>">
            <?= $form->label($filter,'payback')?>
            <?= Crud::activeRange($filter,'payback',$filter::$paybackParam);?>
        </div>
        <div class="field range <?=$filter->extendedFilter? '': 'hidden-filter'?>">
            <?= $form->label($filter,'profit')?>
            <?= Crud::activeRange($filter,'profit',$filter::$profitParam);?>
        </div>
        <div class="field range">
            <?= $form->label($filter,'investSum')?>
            <?= Crud::activeRange($filter,'investSum',$filter::$investSumParam);?>
        </div>
        <div class="field range <?=$filter->extendedFilter? '': 'hidden-filter'?>">
            <?= $form->label($filter,'returnRate')?>
            <?= Crud::activeRange($filter,'returnRate',$filter::$returnRateParam);?>
        </div>
    </div>
    <div class="row">
        <div class="element">
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInvestment',array('uncheckValue' => 0))?>
                <?= $form->label($filter,'isInvestment')?>
            </div>
            <div class="field switcher-child drop <?=$filter->extendedFilter? '': 'hidden-filter'?>">
                <? //$this->widget('crud.dropDownList', array('model'=>$filter, 'attribute'=>'investmentList','elements'=>Project::getIndustryTypeDrop()));?>
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'investmentFormList','elements'=>Project::getFinanceTypeDrop()));?>
            </div>
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInnovative',array('uncheckValue' => 0))?>
                <?= $form->label($filter,'isInnovative')?>
            </div>
            <div class="field switcher-child drop">
                <br>
                <div class="<?=$filter->extendedFilter? '': 'hidden-filter'?>">
                    <div class="field range" style="margin-left: 90px;">
                        <?= $form->label($filter,'innoPrice')?>
                        <?= Crud::activeRange($filter,'innoPrice',$filter::$innoPriceParam);?>
                    </div>
                </div>
                <div class="<?=$filter->extendedFilter? '': 'hidden-filter'?>">
                    <br>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$filter, 'attribute'=>'innovativeList','elements'=>Project::getProjectStepDrop()));?>
                    <br><br>
                </div>
                <div>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$filter, 'attribute'=>'criticalList','elements'=>InnovativeProject::getRelevanceTypeDrop()));?>
                </div>
                <div class="<?=$filter->extendedFilter? '': 'hidden-filter'?>">
                    <br><br>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$filter, 'attribute'=>'innovativeFormList','elements'=>Project::getFinanceTypeDrop()));?>
                </div>
            </div>
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInfrastructure',array('uncheckValue' => 0))?>
                <?= $form->label($filter,'isInfrastructure')?>
            </div>
            <!--div class="field switcher-child drop">
                <?$this->widget('crud.dropDownList',
                array('model'=>$filter, 'attribute'=>'infrastructureList','elements'=>InfrastructureProject::getTypeDrop()  ));?>
            </div-->
        </div>

        <div class="element">
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isBusinessSale',array('uncheckValue' => 0))?>
                <?= $form->label($filter,'isBusinessSale')?>
            </div>
            <div class="field switcher-child drop <?=$filter->extendedFilter? '': 'hidden-filter'?>"">
                <br>
                <div class="field range" style="margin-left: 90px;">
                    <?= $form->label($filter,'busPrice')?>
                    <?= Crud::activeRange($filter,'busPrice',$filter::$busPriceParam);?>
                </div>
                <br>
                <div class="field range" style="margin-left: 90px;">
                    <?= $form->label($filter,'busPart')?>
                    <?= Crud::activeRange($filter,'busPart',$filter::$busPartParam);?>
                </div>
                <br>
            </div>
            <div class="field switcher-parent">
                <?= Crud::activeCheckBox($filter,'isInvestPlatform',array('uncheckValue' => 0))?>
                <?= $form->label($filter,'isInvestPlatform')?>
            </div>
            <div class="field switcher-child drop <?=$filter->extendedFilter? '': 'hidden-filter'?>"">
                <br>
                <div class="field range" style="margin-left: 90px;">
                    <?= $form->label($filter,'siteSquare')?>
                    <?= Crud::activeRange($filter,'siteSquare',$filter::$siteSquareParam);?>
                </div>
                <br>
                <?$this->widget('crud.dropDownList',
                    array('model'=>$filter, 'attribute'=>'locationList','elements'=>InvestmentSite::getLocationTypeDrop()));?>
            </div>
        </div>
        <div class="button-panel center padding">
            <?=CHtml::submitButton(Yii::t('main','Найти'),array('class'=>'btn'))?>
            <?=$filter->extendedFilter? '': CHtml::button(Yii::t('main','Расширенный фильтр'),array('class'=>'btn', 'id' => 'show-extended'))?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<div class="dark-gray-gradient line top bottom short-form">
    <div class="main">

    </div>
</div>