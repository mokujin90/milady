<div class="padding-md">
    <?php
    /**
     * @var $model RegionCity
     * @var $form CActiveForm
     * @var $this AdminRegionController
     * @var $id int
     * @var $new int
     */
    Yii::app()->clientScript->registerScript('init', 'region.city();', CClientScript::POS_LOAD);
    ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
        <?=$form->hiddenField($model,'region_id')?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
            <div class="col-xs-12 col-sm-10">
                <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'name'); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
            <div class="col-xs-12 col-sm-10">
                <?php echo $form->dropDownList($model,'region_id', Region::getDrop(), array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'region_id'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'count_people', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
            <div class="col-xs-12 col-sm-10">
                <?php echo $form->textField($model,'count_people', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'count_people'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="map-block" style="height: 300px;clear: both;padding: 10px 0;">
                <?php $this->widget('Map', array(
                    'projects' => $model,
                    'draggableBalloon'=>true,
                    'htmlOptions'=>array(
                        'style'=>'height: 230px;width:100%;',
                    ),

                )); ?>
                <?=$form->hiddenField($model,'lat',array('id'=>"coords-lat"))?>
                <?=$form->hiddenField($model,'lon',array('id'=>"coords-lon"))?>
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
                        'scale' => '100x100',
                        'scaleMode' => 'in',
                        'needfields' => 'false',
                        'callback'=>'admin',
                        'crop'=>false));
                ?>
                <?php echo CHtml::button(Yii::t('main','Загрузить фото'),array('class'=>'open-dialog btn'))?>
                <?php if($model->media):?>
                    <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                <?php endif;?>
            </div>
            <div class="col-xs-12 col-sm-10">
                    <span id="logo_block" class="rel">
                        <?=Candy::preview(array($model->media, 'scale' => '100x100'))?>
                        <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                    </span>
            </div>

        </div>
        <div class="row buttons text-center">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
        </div>
    <? $this->endWidget(); ?>
</div>

