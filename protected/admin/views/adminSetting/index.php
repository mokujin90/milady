<div class="padding-md">
<?php
/**
 *
 * @var AdminSettingController $this
 * @var Setting[] $models
 * @var array $error
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    'enableAjaxValidation'=>false,
)); ?>
    <?php foreach($models as $model):?>
        <div class="col-xs-12">
            <div class="form-group">
               <?=$model->draw(!isset($error[$model->key]))?>
            </div>

        </div>
    <?php endforeach;?>

    <div class="row buttons text-center">
        <?php echo CHtml::submitButton('Сохранить',array('class'=>'btn')); ?>
    </div>
<? $this->endWidget(); ?>
</div>

