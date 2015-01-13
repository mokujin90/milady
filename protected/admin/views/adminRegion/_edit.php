<?php
/**
 * @var $this RegionContentController
 */

Yii::app()->clientScript->registerScript('init', 'region.init();', CClientScript::POS_READY);
?>

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="/#tab1" role="tab" data-toggle="tab"><?= Yii::t('main','Основная информация')?></a></li>
    <li class=""><a href="/#tab2" role="tab" data-toggle="tab"><?= Yii::t('main','Социальноэк. информация')?></a></li>
    <li class=""><a href="/#tab3" role="tab" data-toggle="tab"><?= Yii::t('main','Инвест. паспорт')?></a></li>
    <li class=""><a href="/#tab4" role="tab" data-toggle="tab"><?= Yii::t('main','Инновац. паспорт')?></a></li>
    <li><a href="/#tab5" role="tab" data-toggle="tab"><?= Yii::t('main','Инфраструкт. паспорт')?></a></li>
</ul>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        "onkeypress"=>"return event.keyCode != 13;"
    )
)); ?>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <?php $this->renderPartial('partial/_main',array(
                'form'=>$form,
                'model'=>$model,
            )); ?>
        </div>
        <div class="tab-pane" id="tab2">
            <?php $this->renderPartial('partial/_social',array(
                'form'=>$form,
                'model'=>$model,
            )); ?>
        </div>
        <div class="tab-pane" id="tab3">
            <?php $this->renderPartial('partial/_investment',array(
                'form'=>$form,
                'model'=>$model,
            )); ?>
        </div>
        <div class="tab-pane" id="tab4">
            <?php $this->renderPartial('partial/_innovation',array(
                'form'=>$form,
                'model'=>$model,
            )); ?>
        </div>
        <div class="tab-pane" id="tab5">
            <?php $this->renderPartial('partial/_infra',array(
                'form'=>$form,
                'model'=>$model,
            )); ?>
        </div>
    </div>
    <div class="row buttons text-center">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
        <?if(!$model->isNewRecord):?>
            <?php echo CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
        <?endif?>
    </div>
<? $this->endWidget(); ?>