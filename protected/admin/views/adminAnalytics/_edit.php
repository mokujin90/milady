<div class="padding-md">
    <?php
    Yii::app()->clientScript->registerPackage('tinymce');
    Yii::app()->clientScript->registerScript('init', 'content.init();', CClientScript::POS_READY);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
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
                    <?php echo $form->textArea($model,'announce',array('rows'=>6, 'class'=>'form-control')); ?>
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
                <?php echo $form->labelEx($model,'category', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->dropDownList($model,'category', Analytics::getCategoryType(),array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'category'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-sm-2">

                </div>
                <div class="col-xs-12 col-sm-10">
                    <div id="logo_block" class="rel m-bottom-xs" data-min-width="<?=Setting::get(Setting::MIN_WIDTH_NEWS_IMAGE)?>" data-min-height="<?=Setting::get(Setting::MIN_HEIGHT_NEWS_IMAGE)?>">
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
                <?php echo $form->labelEx($model,'tags', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'tags',array('class'=>'form-control tags-input')); ?>
                    <?php echo $form->error($model,'tags'); ?>
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
                <?php echo $form->labelEx($model,'on_main', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <label class="label-checkbox inline">
                        <?php echo $form->checkbox($model,'on_main'); ?>
                        <span class="custom-checkbox"></span>
                    </label>
                    <?php echo $form->error($model,'on_main'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'is_main', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <label class="label-checkbox inline">
                        <?php echo $form->checkbox($model,'is_main'); ?>
                        <span class="custom-checkbox"></span>
                    </label>
                    <?php echo $form->error($model,'is_main'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'file_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10 file-block">
                    <?if($model->file):?>
                        <?= CHtml::link('Скачать',$model->file->makeWebPath(),array('style'=>'float: left;', 'class' => 'label label-success'))?>
                        <br>
                    <?endif?>
                        <?php
                        $this->widget('application.components.MediaEditor.MediaEditor',
                            array('data' => array(
                                'items' => null,
                                'field' => 'file_id',
                                'item_container_id' => 'file_block',
                                'button_image_url' => '/images/markup/logo.png',
                                'button_width' => 28,
                                'button_height' => 28,
                            ),
                                'callback'=>'admin',
                                'fileTypes'=>'doc,docx,pdf,txt,zip',
                                'scale' => '300x160',
                                'scaleMode' => 'in',
                                'fileUploadLimit' => '20mb',
                                'fileUploadLimitText' => '20 mb',
                                'needfields' => 'false'));
                        ?>
                        <?php echo CHtml::button(Yii::t('main','Загрузить документ'),array('style'=>'float: left;','class'=>'open-dialog btn btn-primary m-right-xs'))?>
                        <?php if($model->file):?>
                            <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                        <?php endif;?>
                    <div class="col-xs-12 col-sm-10">
                    <span id="file_block" class="rel">
                        <?php echo CHtml::hiddenField('file_id',$model->file_id)?>
                    </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'file_title', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'file_title',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'file_title'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row buttons text-center" style="clear: both;">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
        </div>
    <? $this->endWidget(); ?>
</div>
