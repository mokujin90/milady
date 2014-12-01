<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

    <div class="col-xs-12">
        <div class="form-group">
            <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'announce', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textArea($model,'announce',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'announce'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'full_text', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textArea($model,'full_text',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'full_text'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'create_date', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->dateField($model,'create_date', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'create_date'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'category', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->dropDownList($model,'category', Analytics::getCategoryType(),array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'category'); ?>
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
                        'scale' => '300x160',
                        'scaleMode' => 'in',
                        'needfields' => 'false'));
                ?>
                <?php echo CHtml::button(Yii::t('main','Загрузить фото'),array('class'=>'open-dialog btn'))?>
            </div>
            <div class="col-xs-12 col-sm-8">
                <span id="logo_block" class="rel">
                    <?=Candy::preview(array($model->media, 'scale' => '300x160'))?>
                    <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                </span>
            </div>

        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'tags', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textField($model,'tags',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'tags'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'is_active', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->checkbox($model,'is_active'); ?>
                <?php echo $form->error($model,'is_active'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'on_main', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->checkbox($model,'on_main'); ?>
                <?php echo $form->error($model,'on_main'); ?>
            </div>
        </div>

    </div>
    <div class="row buttons text-center">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
    </div>
<? $this->endWidget(); ?>