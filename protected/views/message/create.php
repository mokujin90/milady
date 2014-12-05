<?
/**
 * @var $this MessageController
 * @var $model Message
 * @var $form CActiveForm
 * @var $systemType bool
 */
$admin = Candy::get($admin,false);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'message-form',
    'enableAjaxValidation'=>false,
)); ?>
<div class="main-column opacity-box">
    <div class="full-column">
        <div class="row">
            <?=$form->textField($model,'subject',array('class'=>'crud','style'=>'width: 100%;','disabled'=>$systemType,'placeholder'=>Yii::t('main','Заголовок сообщения')))?>
            <br/>
            <span class="to"><?= Yii::t('main','Кому')?></span>
            <?if($systemType):?>
                <?=CHtml::textField('Message[user_to_name]',Yii::t('main','Администратор сайта'),array('class'=>'user-value no','blocked'=>true))?>
                <?php if($model->project):?>
                    <br/><?=Yii::t('main','Сообщение по проекту "{project}"',array('{project}'=>$model->project->name))?>
                <?php endif;?>
            <?else:?>
                <?=CHtml::textField('Message[user_to_name]','',array('class'=>'autocomplete user-value no','placeholder'=>Yii::t('main','Введите пользователя')))?>
                <?=$form->hiddenField($model,'user_to',array('class'=>'','id'=>'Message_user_to'))?>
            <?endif;?>

        </div>
        <div class="row">
            <?=$form->textArea($model,'text',array('class' => 'message-textarea', 'placeholder' => Yii::t('main','Текст')))?>
        </div>
        <div class="button-panel">
            <?=$this->renderPartial('application.views.message._upload',array('model'=>$model))?>
            <?=CHtml::submitButton(Yii::t('main','Отправить'),array('class'=>"btn pull-right"))?>
        </div>
        <div id="document_block">

        </div>
    </div>
    <div class="clear"></div>
</div>

<?php $this->endWidget(); ?>
