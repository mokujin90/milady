<?
/**
 * @var $form CActiveForm
 * @var $model Law
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

    <div class="col-xs-12">

        <div class="form-group">
            <?php echo $form->labelEx($model,'email', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'text', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textArea($model,'text', array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'text'); ?>
            </div>
        </div>
    </div>

<? $this->endWidget(); ?>