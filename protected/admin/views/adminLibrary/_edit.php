<div class="padding-md">
    <?
    /**
     * @var $form CActiveForm
     * @var $model Library
     */
    ?>
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
                <?php echo $form->labelEx($model,'division_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->dropDownList($model,'division_id',Library::getDrop(), array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'division_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'title', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'title', array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'media_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10 file-normal-name">
                    <?if($model->media):?>
                        <?=$form->textField($model,'normal_name',array('class'=>'form-control'))?>
                        <?= CHtml::link('Скачать',$model->media->makeWebPath(),array('style'=>'float: left;'))?>
                    <?else:?>
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
                                'callback'=>'library',
                                'fileTypes'=>'doc,docx,pdf,txt,zip',
                                'scale' => '300x160',
                                'scaleMode' => 'in',
                                'needfields' => 'false'));
                        ?>
                        <?php echo CHtml::button(Yii::t('main','Загрузить документ'),array('style'=>'float: left;','class'=>'open-dialog btn'))?>
                    <?endif;?>
                    <div class="col-xs-12 col-sm-10">
                    <span id="logo_block" class="rel">
                        <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                        <?php echo CHtml::hiddenField('normal_name',$model->normal_name)?>

                    </span>
                    </div>
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