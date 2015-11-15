<div id="general" class="padding-md">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('class' => 'form-horizontal no-margin form-border')
        )); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                Новость проекта
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div id="logo_block" class="profile-image col-lg-2">
                        <span class="rel">
                            <?=Candy::preview(array($model->media, 'scale' => '102x102'))?>
                            <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                        </span>
                    </div>
                    <div class="col-lg-10">
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
                                'scale' => '102x102',
                                'scaleMode' => 'out',
                                'needfields' => 'false',
                                'crop'=>true));
                        ?>
                        <div class="open-dialog load-action btn btn-success"><?= Yii::t('main','Загрузить изображение')?></div>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'name', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'name',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'announce', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model,'announce',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'announce'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'full_text', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model,'full_text',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'full_text'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="button-panel center">
            <?=CHtml::submitButton($model->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn btn-success'))?>
        </div>
    <?php $this->endWidget(); ?>
</div>
