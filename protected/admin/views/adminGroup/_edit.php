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

        <div class="form-group">
            <div class="col-xs-12 col-sm-2">
            </div>
            <div class="col-xs-12 col-sm-10">
                    <div id="logo_block" class="rel m-bottom-xs" data-min-width="<?=Setting::get(Setting::MIN_WIDTH_NEWS_IMAGE)?>" data-min-height="<?=Setting::get(Setting::MIN_HEIGHT_NEWS_IMAGE)?>">
                        <?=Candy::preview(array($model->media, 'scale' => '100x100'))?>
                        <?php echo CHtml::hiddenField('media_id',$model->media_id,array('data-min-width'=>Setting::get(Setting::MIN_WIDTH_NEWS_IMAGE)))?>
                    </div>
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
                        'scale' => '100x100',
                        'scaleMode' => 'in',
                        'needfields' => 'false',
                        'callback'=>'admin',
                        'crop'=>true));
                ?>
                <?php echo CHtml::button(Yii::t('main','Загрузить фото'),array('class'=>'open-dialog btn btn-primary m-right-xs'))?>
                <?php if($model->media):?>
                    <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                <?php endif;?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'background_media_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
            <div class="col-xs-12 col-sm-10">
                <div id="logo_block_2" class="remove-logo-block rel m-bottom-xs" data-min-width="<?=Setting::get(Setting::MIN_WIDTH_NEWS_IMAGE)?>" data-min-height="<?=Setting::get(Setting::MIN_HEIGHT_NEWS_IMAGE)?>">
                    <?=Candy::preview(array($model->backgroundMedia, 'scale' => '100x100'))?>
                    <?php echo CHtml::hiddenField('background_media_id',$model->background_media_id,array('data-min-width'=>Setting::get(Setting::MIN_WIDTH_NEWS_IMAGE)))?>
                </div>
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
                        'scale' => '100x100',
                        'scaleMode' => 'out',
                        'needfields' => 'false',
                        'callback'=>'admin',
                        'crop'=>false));
                ?>
                <?php echo CHtml::button(Yii::t('main','Загрузить фон'),array('class'=>'open-dialog btn btn-primary m-right-xs'))?>
                <?php if($model->media):?>
                    <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                <?php endif;?>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'name', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'desc', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'desc', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'desc'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'type_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->dropDownList($model,'type_id', ReferenceGroupType::getDrop(),array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'type_id'); ?>
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
