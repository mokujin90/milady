<?
/**
 * @var InvestorController $this
 * @var InvestorFilter $filter
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScriptFile('/js/vendor/ion.rangeSlider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('/css/vendor/ion.rangeSlider.css');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter',
    'action'=>$this->createUrl(''),
    'method'=>'get',
    'htmlOptions'=>array('class'=>'opacity-box form filter-form'
    ))); ?>
<?=$form->textField($filter,'name',array('class'=>'filter__field', 'placeholder' => Yii::t('main', 'Компания/ФИО')))?>

<?$this->widget('crud.dropDownList',
    array('model'=>$filter, 'attribute'=>'investorType','elements'=>Project::getObjectTypeDrop(),
        'options'=>array(
            'multiple'=>true
        ))
);?>
<br>
<!--div class="p-filter-add"-->
    <br>
    <?$this->widget('crud.dropDownList',
        array('model'=>$filter, 'attribute'=>'industry','elements'=>Project::getIndustryTypeDrop(),
            'options'=>array(
                'multiple'=>true
            ))
    );?>
    <br><br>
    <?$this->widget('crud.dropDownList',
        array('model'=>$filter, 'attribute'=>'country','elements'=>Country::getDrop(),
            'options'=>array(
                'multiple'=>true
            ))
    );?>
    <br><br>
    <div class="field range">
        <?= $form->label($filter,'investmentAmount')?>
        <?= Crud::activeRange($filter,'investmentAmount',$filter::$investmentAmountParam);?>
    </div>
<!--/div--><!--p-filter-add-->

<!--div class="p-filter-block__add">
    <span>Подробный фильтр</span>
</div-->
<div class="text-center margin-xs">
    <?=CHtml::link(Yii::t('main','Сбросить'),array('index'),array('class'=>'filter__reset_btn'))?>
</div>

<?=CHtml::submitButton(Yii::t('main','НАЙТИ'),array('class'=>'blue-btn full-width'))?>
<?php $this->endWidget(); ?>

<!--div class="content columns no-transform full-form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter',
        'action'=>$this->createUrl(''),
        'method'=>'get',
        'htmlOptions'=>array('class'=>'opacity-box form filter-form'
        ))); ?>
    <h2><?= Yii::t('main','Поиск инвестора')?></h2>
    <h3></h3>

    <div class="row">

        <div class="element">

        </div>
        <div class="button-panel center padding">
            <?=CHtml::submitButton(Yii::t('main','Найти'),array('class'=>'btn'))?>
            <?=CHtml::link(Yii::t('main','Сбросить'),array('index'),array('class'=>'btn'))?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<div class="dark-gray-gradient line top bottom short-form">
    <div class="main">

    </div>
</div-->