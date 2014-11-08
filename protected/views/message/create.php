<?
/**
 * @var $this MessageController
 * @var $model Message
 * @var $form CActiveForm
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'message-form',
    'enableAjaxValidation'=>false,
)); ?>
<div class="main-column opacity-box">
    <div class="full-column">
        <div class="row">
            <?=$form->textField($model,'subject',array('class'=>'crud','style'=>'width: 100%;','placeholder'=>Yii::t('main','Заголовок сообщения')))?>
            <br/>
            <span class="to"><?= Yii::t('main','Кому')?></span>
            <?=CHtml::textField('Message[user_to_name]','',array('class'=>'autocomplete user-value no','placeholder'=>Yii::t('main','Введите пользователя')))?>
            <?=$form->hiddenField($model,'user_to',array('class'=>'','id'=>'Message_user_to'))?>
        </div>
        <div class="row">
            <?=$form->textArea($model,'text',array('class' => 'message-textarea', 'placeholder' => Yii::t('main','Текст')))?>
        </div>
        <div class="button-panel">
            <?=$this->renderPartial('_upload',array('model'=>$model))?>
            <?=CHtml::submitButton(Yii::t('main','Отправить'),array('class'=>"btn pull-right"))?>
        </div>
        <div id="document_block">

        </div>
    </div>
    <div class="clear"></div>
</div>
<?php $this->endWidget(); ?>
