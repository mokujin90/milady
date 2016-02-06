<div class="padding-md">
    <?php
    Yii::app()->clientScript->registerPackage('tinymce');
    Yii::app()->clientScript->registerScript('init', 'content.init();', CClientScript::POS_READY);

    ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
    <?php echo $form->errorSummary($model); ?>

        <div class="col-xs-12" style="margin-bottom: 10px;">
            <?if($model->system_type == 'contacts'){?>
                <div class="form-group">
                    <div class="map-block" style="height: 300px;clear: both;padding: 10px 0;">
                        <?php $this->widget('Map', array(
                            'target' => true,
                            'sideModel' =>$model->contacts,
                            'draggableBalloon'=>true,
                            'htmlOptions'=>array(
                                'style'=>'height: 230px;width:100%;',
                            ),

                        )); ?>
                        <?=$form->hiddenField($model->contacts,'lat',array('id'=>"coords-lat"))?>
                        <?=$form->hiddenField($model->contacts,'lon',array('id'=>"coords-lon"))?>
                    </div>
                </div>
            <?}?>

            <?if($model->system_type == 'about'){?>

            <div class="form-group" style="overflow: visible;">
                <?php echo $form->labelEx($model,'aboutPages', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?=$form->dropDownList($model,'aboutPages',Content::getAboutPagesList(),array('multiple'=>true,'class'=>'chosen','placeholder'=>Yii::t('main','Добавьте страницы...')))?>
                    <?php echo $form->error($model,'aboutPages'); ?>
                </div>
            </div>
            <?}?>

            <?if($model->system_type == 'team'){?>
                <div class="form-group" style="overflow: visible;">
                    <?php echo $form->labelEx($model,'teamUsers', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                    <div class="col-xs-12 col-sm-10">
                        <?=$form->dropDownList($model,'teamUsers',User::getAutocompleteDrop(),array('multiple'=>true,'class'=>'chosen','placeholder'=>Yii::t('main','Добавьте пользователей...')))?>
                        <?php echo $form->error($model,'teamUsers'); ?>
                    </div>
                </div>
            <?}?>

            <?if(is_null($model->type) && $model->system_type == 'default'){?>
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
            <?}?>

            <div class="form-group">
                <?php echo $form->labelEx($model,'content', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'form-control rte')); ?>
                    <?php echo $form->error($model,'content'); ?>
                </div>
            </div>
        </div>
        <div class="row buttons text-center ">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
            <?if(!$model->isNewRecord):?>
                <?php echo CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
        </div>
    <? $this->endWidget(); ?>
</div>

