<?
/**
 * @var $this MessageController
 * @var $model Message
 * @var $answer Message
 * @var $form CActiveForm
 */
$action = $this->actionName;
$isSystem = is_null($model->user_from);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'message-form',
    'enableAjaxValidation'=>false,
    'action'=>$this->createUrl('message/create')
)); ?>
    <div class="main-column opacity-box">
        <div class="full-column">
            <?if($action!='view'):?>
                <div class="row">
                    <?=CHtml::label('От кого', 'description',array('style'=>'display: inline-block;'))?>
                    <span class="user-value"><?=$model->userFrom->name?></span>
                </div>
            <?else:?>
                <div class="row">
                    <?=CHtml::label('Кому', 'description',array('style'=>'display: inline-block;'))?>
                    <span class="user-value"><?=$model->userTo->name?></span>
                </div>
            <?endif;?>
            <div class="row">
                <?=CHtml::textArea('text_message', $model->text, array('class' => 'message-textarea','readonly'=>true))?>
            </div>
            <div id="file-list">
                <?=$this->drawFileList($model->files)?>
            </div>
            <?php if(!$isSystem):?>
                <div class="row extra-margin">
                    <?=CHtml::label('Ответить', 'description')?>
                    <?=$form->textField($answer,'subject',array('class'=>'crud','style'=>'width: 100%;'))?>
                    <?=Candy::error($answer,'subject')?>
                </div>
                <div class="row extra-margin">
                    <?=$form->textArea($answer, 'text', array('class' => 'reply-message-textarea', 'placeholder' => 'Текст'))?>
                    <?=Candy::error($answer,'text')?>
                </div>
                <div class="button-panel">
                    <?=$this->renderPartial('_upload',array('model'=>$model))?>
                    <?=CHtml::submitButton(Yii::t('main','Отправить'),array('class'=>"btn pull-right"))?>
                </div>
                <div id="document_block">

                </div>
            <?php endif;?>

        </div>
        <div class="clear"></div>
    </div>
    <?=$form->hiddenField($answer,'user_to')?>
<?php $this->endWidget(); ?>