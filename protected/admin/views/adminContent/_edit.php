<?php
Yii::app()->clientScript->registerScript('init', 'content.init();', CClientScript::POS_READY);

?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

    <div class="col-xs-12">
        <div class="form-group">
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'content'); ?>
            </div>
        </div>

    </div>
    <div class="row buttons text-center">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
    </div>
<? $this->endWidget(); ?>