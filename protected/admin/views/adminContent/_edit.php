<div class="padding-md">
    <?php
    Yii::app()->clientScript->registerPackage('tinymce');
    Yii::app()->clientScript->registerScript('init', 'content.init();', CClientScript::POS_READY);

    ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
    <?php echo $form->errorSummary($model); ?>

        <div class="col-xs-12" style="margin-bottom: 10px;">
            <?if(is_null($model->type)){?>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                    <div class="col-xs-12 col-sm-10">
                        <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'url', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                    <div class="col-xs-12 col-sm-10">
                        <?php echo $form->textField($model,'url', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'url'); ?>
                    </div>
                </div>
            <?}?>

            <div class="form-group">
                <?php echo $form->labelEx($model,'content', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'form-control rte')); ?>
                    <?php echo $form->error($model,'content'); ?>
                </div>
            </div>
        </div>
        <div class="row buttons text-center ">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
            <?if(!$model->isNewRecord):?>
                <?php echo CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
        </div>
    <? $this->endWidget(); ?>
</div>

