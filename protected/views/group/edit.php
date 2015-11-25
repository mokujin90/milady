<?
/**
 * @var $this GroupController
 * @var $model Group
 * @var $form CActiveForm
 */
?>
<div id="general" class="padding-md">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('id' => 'formToggleLine', 'class' => 'form-horizontal no-margin form-border')
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Группа
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div id="logo_block" class="profile-image col-lg-2">
                            <span class="rel">
                                <?=Candy::preview(array($model->media, 'scale' => '102x102', 'class' => 'img-circle'))?>
                                <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                            </span>
                </div>
                <div class="col-lg-10">

                    <?php
                    $this->widget('application.components.MediaEditor.MediaEditor',
                        array('data' => array(
                            'items' => null,
                            'field' => 'media_id',
                            'item_container_id' => 'logo_block',
                            'button_image_url' => '/images/markup/logo.png',
                            'button_width' => 28,
                            'button_height' => 28,
                        ),
                            'scale' => '102x102',
                            'scaleMode' => 'in',
                            'needfields' => 'false',
                            'crop'=>true
                        ));
                    ?>
                    <div class="open-dialog load-action btn btn-success"><?= Yii::t('main','Загрузить логотип')?></div>
                    <span class="help-block"> Рекомендуемые параметры: Размер не менее 100х100. Пропорции сторон 1 к 1</span>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            <div class="form-group">
                <?php echo $form->labelEx($model,'desc', array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textArea($model,'desc',array('class' => 'form-control')); ?>
                    <?php echo $form->error($model,'desc'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->
        </div>
    </div>

    <?=CHtml::submitButton('Сохранить',array('class'=>'btn btn-success btn-sm'))?>

    <?php $this->endWidget(); ?>
</div>