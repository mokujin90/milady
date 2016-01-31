<div class="padding-md">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
    <?php echo $form->errorSummary($model); ?>

        <div class="col-xs-12" style="margin-bottom:10px;">
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'name'); ?>
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
                <?php echo $form->labelEx($model,'type_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->dropDownList($model,'type_id', CHtml::listData(ReferenceRegionCompanyType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'type_id'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'email', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'phone', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'phone', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'phone'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'address', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'address', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'address'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'INN', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'INN', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'INN'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'OGRN', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'OGRN', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'OGRN'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'CPP', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'CPP', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'CPP'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-2">
                </div>
                <div class="col-xs-12 col-sm-10">
                    <div id="logo_block" class="rel m-bottom-xs">
                        <?=Candy::preview(array($model->media, 'scaleMode' => 'in', 'scale' => '100x100'))?>
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
                            'callback'=>'admin'));
                    ?>
                    <?php echo CHtml::button(Yii::t('main','Загрузить лого'),array('class'=>'open-dialog btn btn-primary m-right-xs'))?>
                    <?php if($model->media):?>
                        <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                    <?php endif;?>
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
