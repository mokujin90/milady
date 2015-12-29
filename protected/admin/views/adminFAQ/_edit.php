<?Yii::app()->clientScript->registerPackage('tinymce');
Yii::app()->clientScript->registerScript('init', 'content.init();', CClientScript::POS_READY);
?>
<div class="padding-md">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
    <?php echo $form->errorSummary($model); ?>

        <div class="col-xs-12">
            <div class="form-group">
                <?php echo $form->labelEx($model,'question', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'question', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'question'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'answer', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'answer',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'answer'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'parent_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->dropDownList($model,'parent_id',array('' => '---') + CHtml::listData(FAQ::model()->findAll('id != ' . (empty($model->id) ? 0 : $model->id)), 'id', 'question'), array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'parent_id'); ?>
                </div>
            </div>
            <br>
        </div>
        <div class="row buttons text-center">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
            <?if(!$model->isNewRecord):?>
                <?php echo CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
        </div>
    <? $this->endWidget(); ?>
</div>
