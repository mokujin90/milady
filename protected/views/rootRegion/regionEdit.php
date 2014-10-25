<?php
/**
 * @var $this RegionContentController
 */
Yii::app()->clientScript->registerScript('init', 'root.init();', CClientScript::POS_READY);
?>
<div class="form root-page">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<?
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
        Yii::t('main','Основная информация')=>array(
            'id'=>'main-id',
            'content'=>$this->renderPartial('partial/_main',array('form'=>$form,'model'=>$model),true)
        ),
        Yii::t('main','Социально­экономическая информация')=>array(
            'id'=>'social-id',
            'content'=>$this->renderPartial('partial/_social',array('form'=>$form,'model'=>$model),true)
        ),
        Yii::t('main','Инвестиционный паспорт')=>array(
            'id'=>'investment-id',
            'content'=>$this->renderPartial('partial/_investment',array('form'=>$form,'model'=>$model),true)
        ),
        Yii::t('main','Инновационный паспорт')=>array(
            'id'=>'innovation-id',
            'content'=>$this->renderPartial('partial/_innovation',array('form'=>$form,'model'=>$model),true)
        ),
        Yii::t('main','Инфраструктурный паспорт')=>array(
            'id'=>'infra-id',
            'content'=>$this->renderPartial('partial/_infra',array('form'=>$form,'model'=>$model),true)
        ),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        //'collapsible'=>true,
    ),
));
?>


<div class="row buttons text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->