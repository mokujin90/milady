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
                <div id="logo_block_2" class="no-circle profile-image col-lg-2">
                            <span class="rel">
                                <?=Candy::preview(array($model->backgroundMedia, 'scale' => '102x102', 'class' => 'img-circle'))?>
                                <?php echo CHtml::hiddenField('background_media_id',$model->background_media_id)?>
                            </span>
                </div>
                <div class="col-lg-10">

                    <?php
                    $this->widget('application.components.MediaEditor.MediaEditor',
                        array('data' => array(
                            'items' => null,
                            'field' => 'background_media_id',
                            'item_container_id' => 'logo_block_2',
                            'button_image_url' => '/images/markup/logo.png',
                            'button_width' => 28,
                            'button_height' => 28,
                        ),
                            'scale' => '102x102',
                            'scaleMode' => 'in',
                            'needfields' => 'false',
                            'crop'=>false
                        ));
                    ?>
                    <div class="open-dialog load-action btn btn-success"><?= Yii::t('main','Загрузить фон')?></div>
                    <!--span class="help-block"> Рекомендуемые параметры: Размер не менее 100х100. Пропорции сторон 1 к 1</span-->
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
            <div class="form-group">
                <?php echo $form->labelEx($model,'type_id', array('class' => "col-lg-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->dropDownList($model,'type_id', ReferenceGroupType::getDrop(),array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'type_id'); ?>
                </div>
            </div>
        </div>
    </div>

    <?=CHtml::submitButton('Сохранить',array('class'=>'btn btn-success btn-sm'))?>

    <?php $this->endWidget(); ?>
</div>
<?if(!$model->isNewRecord) {?>
<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b><?= Yii::t('main','Обсуждения')?></b>
            <?=CHtml::link(Yii::t('main','Создать'), $this->createUrl('group/discussionCreate', array('id' => $model->id)), array('class'=>'btn btn-xs btn-success pull-right'))?>
        </div>

        <table class="table table-striped" id="responsiveTable">
            <tbody>
            <?if(empty($models)):?>
                <tr><td colspan="3">Список пуст</td></tr>
            <?endif?>
            <?foreach($models as $model):?>
                <tr class="item">
                    <td><?=$model->name;?></td>
                    <td style="width: 50px;"><?=CHtml::link(Yii::t('main','Редактировать'),array('discussionUpdate','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                    <td style="width: 60px;"><?=CHtml::link(Yii::t('main','Удалить'),array('discussionDelete','id'=>$model->id),array('class'=>'btn btn-xs btn-danger', 'onclick' => 'return confirm("Удалить?")'))?></td>
                </tr>
            <?endforeach?>
            </tbody>
        </table>
    </div>
</div>
<?}?>