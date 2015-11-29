<div class="padding-md">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
    
        <div class="col-xs-12" style="margin-bottom: 10px;">
    
            <div class="form-group">
               <label class="col-xs-12 col-sm-2 control-label">Место размещения:</label>
                <div class="col-xs-12 col-sm-10">
                   <?=StaticBanner::getPlace($model->place_id)?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'url', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'url', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'url'); ?>
                </div>
            </div>
    
            <div class="form-group">
                <div class="col-xs-12 col-sm-2">
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
                            'needfields' => 'false',
                            'crop'=>true));
                    ?>
                    <?php echo CHtml::button(Yii::t('main','Загрузить фото'),array('class'=>'open-dialog btn'))?>
                </div>
                <div class="col-xs-12 col-sm-10">
                    <span id="logo_block" class="rel">
                        <?=Candy::preview(array($model->media, 'scale' => $model->getSize()))?>
                        <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                    </span>
                </div>
            </div>
        </div>
        <div class="row buttons text-center">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
            <?if(!$model->isNewRecord):?>
                <?php echo CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
        </div>
    <? $this->endWidget(); ?>
</div>

    