<?php
/**
 * @var $model Banner
 * @var $form CActiveForm
 */
$form = new CActiveForm;
$this->blockJquery();
Yii::app()->clientScript->registerScript('chosen-ajax', 'init.chosen(".chosen.ajax");', CClientScript::POS_READY);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('main','Дополнительные настройки для инвесторов')?>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <?php echo $form->labelEx($model,'investor_amount',array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-10">
                <?php echo CHtml::textField('Banner[investor_amount]', $model->recommendInvestorAmount(),array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'investor_amount'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
        <div class="form-group">
            <?php echo $form->labelEx($model,'banner2country',array('class' => 'col-lg-2 control-label','label'=>Yii::t('main','Страна для инвестиций'))); ?>
            <div class="col-lg-10" style="padding-top: 5px">
                <?=CHtml::dropDownList('banner2country',CHtml::listData($model->banner2Countries, 'id', 'country_id'),Country::getDrop(),array('class'=>'chosen ajax','multiple' => true,'placeholder'=>' ','id'=>'country-list'))?>
                <?php echo Candy::error($model, 'banner2country'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
        <div class="form-group">
            <?php echo $form->labelEx($model,'banner2investorType',array('class' => 'col-lg-2 control-label','label'=>Yii::t('main','Тип инвестора'))); ?>
            <div class="col-lg-10" style="padding-top: 5px">
                <?=CHtml::dropDownList('banner2investorType',CHtml::listData($model->banner2InvestorTypes, 'id', 'type_id'),Project::getObjectTypeDrop(),array('class'=>'chosen ajax','multiple' => true,'placeholder'=>' ','id'=>'investor-type-list'))?>
                <?php echo Candy::error($model, 'banner2investorType'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
        <div class="form-group">
            <?php echo $form->labelEx($model,'banner2industry',array('class' => 'col-lg-2 control-label','label'=>Yii::t('main','Предпочтительные отрасли'))); ?>
            <div class="col-lg-10" style="padding-top: 5px">
                <?=CHtml::dropDownList('banner2industry',CHtml::listData($model->banner2Industries, 'id', 'industry_id'),Project::getIndustryTypeDrop(),array('class'=>'chosen ajax','multiple' => true,'placeholder'=>' ','id'=>'investor-industry-list'))?>
                <?php echo Candy::error($model, 'banner2industry'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
    </div>
</div>