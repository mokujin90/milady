<div id="general">
    <div class="content list-columns columns">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
        )); ?>
        <div class="side-column opacity-box">
            <div id="logo_block" class="profile-image">
                        <span class="rel">
                            <?=Candy::preview(array($model->media, 'scale' => '102x102'))?>
                            <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                        </span>
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
                    'scale' => '102x102',
                    'scaleMode' => 'out',
                    'needfields' => 'false',
                    'crop'=>true));
            ?>

            <div class="open-dialog load-action"><?= Yii::t('main','Загрузить изображение')?></div>
        </div>
        <div class="main-column opacity-box">
            <div class="full-column">
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'announce'); ?>
                    <?php echo $form->textArea($model,'announce',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model,'announce'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'full_text'); ?>
                    <?php echo $form->textArea($model,'full_text',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model,'full_text'); ?>
                </div>
                <div class="button-panel center">
                    <?=CHtml::submitButton($model->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn'))?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
