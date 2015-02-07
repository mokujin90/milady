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
)); ?>
    <?=$form->hiddenField($model,'region_id')?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'name'); ?>

        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->dropDownList($model,'region_id', Region::getDrop(), array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'region_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'count_people', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
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
    <div class="row buttons text-center">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
    </div>
<? $this->endWidget(); ?>