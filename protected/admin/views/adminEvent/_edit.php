<div class="padding-md">
    
    <?php
    Yii::app()->clientScript->registerPackage('tinymce');
    Yii::app()->clientScript->registerScript('init', 'content.init();', CClientScript::POS_READY);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border',
            "onkeypress"=>"return event.keyCode != 13;",
        )
    )); ?>
    <?php echo $form->errorSummary($model); ?>
        <div class="col-xs-12">
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
            </div>
    
            <div class="form-group">
                <?php echo $form->labelEx($model,'announce', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'announce',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'announce'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'full_text', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'full_text',array('rows'=>6, 'cols'=>50, 'class'=>'form-control rte')); ?>
                    <?php echo $form->error($model,'full_text'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'create_date', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'create_date', array('data-provide' => "datepicker",
                        'data-date-format' => "yyyy-mm-dd",
                        'data-date-today-highlight' => "true",
                        'data-date-language' => "en-GB",
                        'class' => 'form-control',)); ?>
                    <?php echo $form->error($model,'create_date'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'author', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'author', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'author'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'tags', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'tags', array('class'=>'form-control tags-input')); ?>
                    <?php echo $form->error($model,'tags'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'source', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'source', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'source'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'contacts', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'contacts', array('class'=>'form-control rte')); ?>
                    <?php echo $form->error($model,'contacts'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-2">
                </div>
                <div class="col-xs-12 col-sm-10">
                    <div id="logo_block" class="rel m-bottom-xs">
                        <?=Candy::preview(array($model->media, 'scale' => '300x160'))?>
                        <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
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
                            'scale' => '300x160',
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
                <?php echo $form->labelEx($model,'is_active', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <label class="label-checkbox inline">
                        <?php echo $form->checkbox($model,'is_active'); ?>
                        <span class="custom-checkbox"></span>
                    </label>
                    <?php echo $form->error($model,'is_active'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="map-block" style="height: 300px;clear: both;padding: 10px 0;">
                    <?php $this->widget('Map', array(
                        'id'=>'map',
                        'projects' => $model,
                        'draggableBalloon'=>true,
                        'htmlOptions'=>array(
                            'style'=>'height:300px'
                        )
                    )); ?>
                    <?=$form->hiddenField($model,'lat',array('id'=>'coords-lat'))?>
                    <?=$form->hiddenField($model,'lon',array('id'=>'coords-lon'))?>
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
    