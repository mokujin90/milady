<?php
/**
 * @var $model Banner
 * @var $form CActiveForm
 */
$form = new CActiveForm;
$this->blockJquery();
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
            <div class="col-lg-12">
                <?$this->widget('crud.dropDownList',
                    array('selected' => CHtml::listData($model->banner2Countries, 'id', 'country_id'), 'elements' => Country::getDrop(),
                        'options' => array('multiple' => true, 'placeholder' => Yii::t('main','Страна для инвестиций')),
                        'id' => 'country-list',
                        'name' => 'banner2country'
                    ));?>
                <?php echo Candy::error($model, 'banner2country'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
        <div class="form-group">
            <div class="col-lg-12">
                <?$this->widget('crud.dropDownList',
                    array('selected' => CHtml::listData($model->banner2InvestorTypes, 'id', 'type_id'), 'elements' => Project::getObjectTypeDrop(),
                        'options' => array('multiple' => true, 'placeholder' => Yii::t('main','Тип инвестора')),
                        'id' => 'investor-type-list',
                        'name' => 'banner2investorType'
                    ));?>
                <?php echo Candy::error($model, 'banner2investorType'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
        <div class="form-group">
            <div class="col-lg-12">
                <?$this->widget('crud.dropDownList',
                    array('selected' => CHtml::listData($model->banner2Industries, 'id', 'industry_id'), 'elements' => Project::getIndustryTypeDrop(),
                        'options' => array('multiple' => true, 'placeholder' => Yii::t('main','Предпочтительные отрасли')),
                        'id' => 'investor-industry-list',
                        'name' => 'banner2industry'
                    ));?>
                <?php echo Candy::error($model, 'banner2industry'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
    </div>
</div>