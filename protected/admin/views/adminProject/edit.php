<?php
/**
 * @var $this AdminProjectController
 * @var $model Project
 */
Yii::app()->clientScript->registerCoreScript('ckeditor');
Yii::app()->clientScript->registerScript('init', 'project.init();', CClientScript::POS_READY);
Yii::app()->clientScript->registerCssFile('/css/vendor/jquery-ui.min.css');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'project-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        "onkeypress"=>"return event.keyCode != 13;",
        'class' => 'form-horizontal no-margin form-border'
    )
)); ?>
<div class="padding-md" style="padding-bottom: 0 !important;">
    <div class="panel panel-default" style="margin-bottom: 0 !important;">
        <div class="panel-heading">
            <?php echo $model->getProjectType()?>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $form->labelEx($model,'user_id', array('class' => 'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?=$form->dropDownList($model,'user_id',array('' => '---') + User::getAutocompleteDrop(),array('class'=>'chosen'))?>
                    <?php echo $form->error($model,'user_id'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->

            <div class="form-group">
                <div id="logo_block" class="profile-image col-lg-2">
                <span class="rel">
                    <?=Candy::preview(array($model->logo, 'scale' => '102x102'))?>
                    <?php echo CHtml::hiddenField('logo_id',$model->logo_id)?>
                </span>
                </div>
                <div class="col-lg-10">
                    <?php
                    $this->widget('application.components.MediaEditor.MediaEditor',
                        array('data' => array(
                            'items' => null,
                            'field' => 'logo_id',
                            'item_container_id' => 'logo_block',
                            'button_image_url' => '/images/markup/logo.png',
                            'button_width' => 28,
                            'button_height' => 28,
                        ),
                            'scale' => '102x102',
                            'scaleMode' => 'in',
                            'needfields' => 'false',
                            'crop'=>true
                        ));
                    ?>
                    <div class="open-dialog load-action btn btn-success"><?= Yii::t('main','Загрузить логотип')?></div>
                    <span class="help-block"> Рекомендуемые параметры: Размер не менее 100х100. Пропорции сторон 1 к 1</span>
                </div><!-- /.col -->
            </div><!-- /form-group -->

            <div class="map-block">
                <?php $this->widget('Map', array(
                    'id'=>'map',
                    'projects'=>array($model),
                    'draggableBalloon'=>true
                )); ?>
                <?=$form->hiddenField($model,'lat',array('id'=>'coords-lat'))?>
                <?=$form->hiddenField($model,'lon',array('id'=>'coords-lon'))?>
            </div>
        </div>
    </div>
</div>

    <?php $this->renderPartial('application.views.user.'.lcfirst($contentModel),array(
        'form'=>$form,
        'model'=>$model,
        'admin'=>true,
        'regions'=>$regions = Region::model()->findAll()
    )); ?>

<? $this->endWidget(); ?>
