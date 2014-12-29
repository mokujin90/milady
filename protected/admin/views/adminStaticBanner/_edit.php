<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    'enableAjaxValidation'=>false,
)); ?>

    <div class="col-xs-12">

        <div class="form-group">
           Место размещения:
            <div class="col-xs-12 col-sm-8">
               <?=StaticBanner::getPlace($model->place_id)?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'url', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textField($model,'url', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'url'); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-4">
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
                        'scale' => $model->getSize(),
                        'scaleMode' => 'out',
                        'needfields' => 'false'));
                ?>
                <?php echo CHtml::button(Yii::t('main','Загрузить фото'),array('class'=>'open-dialog btn'))?>
            </div>
            <div class="col-xs-12 col-sm-8">
                <span id="logo_block" class="rel">
                    <?=Candy::preview(array($model->media, 'scale' => $model->getSize()))?>
                    <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                </span>
            </div>
        </div>
    </div>
    <div class="row buttons text-center">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
    </div>
<? $this->endWidget(); ?>