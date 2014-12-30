<?php
/**
 * @var $model Banner
 * @var $form CActiveForm
 */
$form = new CActiveForm;
$this->blockJquery();
?>
<h2><?= Yii::t('main','Дополнительные настройки для инвесторов')?></h2>
<div class="row">
    <?php echo $form->labelEx($model, 'investor_amount'); ?>
    <?php echo CHtml::textField('Banner[investor_amount]', $model->recommendInvestorAmount()); ?>
    <?php echo $form->error($model, 'investor_amount'); ?>
</div>
<div class="row">
    <?$this->widget('crud.dropDownList',
        array('selected' => CHtml::listData($model->banner2Countries, 'id', 'country_id'), 'elements' => Country::getDrop(),
            'options' => array('multiple' => true, 'placeholder' => Yii::t('main','Страна для инвестиций')),
            'id' => 'country-list',
            'name' => 'banner2country'
        ));?>
    <?php echo Candy::error($model, 'banner2country'); ?>
</div>
<div class="row">
    <?$this->widget('crud.dropDownList',
        array('selected' => CHtml::listData($model->banner2InvestorTypes, 'id', 'type_id'), 'elements' => Project::getObjectTypeDrop(),
            'options' => array('multiple' => true, 'placeholder' => Yii::t('main','Тип инвестора')),
            'id' => 'investor-type-list',
            'name' => 'banner2investorType'
        ));?>
    <?php echo Candy::error($model, 'banner2investorType'); ?>
</div>
<div class="row">
    <?$this->widget('crud.dropDownList',
        array('selected' => CHtml::listData($model->banner2Industries, 'id', 'industry_id'), 'elements' => Project::getIndustryTypeDrop(),
            'options' => array('multiple' => true, 'placeholder' => Yii::t('main','Предпочтительные отрасли')),
            'id' => 'investor-industry-list',
            'name' => 'banner2industry'
        ));?>
    <?php echo Candy::error($model, 'banner2industry'); ?>
</div>