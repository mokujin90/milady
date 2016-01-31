<?
/**
 * @var $this GroupController
 * @var $model Group
 * @var $form CActiveForm
 */
?>
<style>
    .no-circle .img-circle{
        border-radius: 0 !important;
    }
</style>
<div id="general" class="padding-md">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('id' => 'formToggleLine', 'class' => 'form-horizontal no-margin form-border')
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Обсуждение
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->
        </div>
    </div>

    <?=CHtml::submitButton('Сохранить',array('class'=>'btn btn-success btn-sm'))?>

    <?php $this->endWidget(); ?>
</div>