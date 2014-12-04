<?
/**
 * @var $this MessageController
 * @var $model Message
 * @var $answer Message
 * @var $form CActiveForm
 */
$admin = Candy::get($admin,false);
$action = Yii::app()->controller->action->id;
$isSystem = is_null($model->user_from) || is_null($model->user_to);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'message-form',
    'enableAjaxValidation'=>false,
    'action'=>$this->createUrl($admin ? 'adminMessages/create' : 'message/create')
)); ?>
    <div class="main-column opacity-box">
        <div class="full-column">
            <?if($action!='view'):?>
                <div class="row">
                    <?=CHtml::label('От кого', 'description',array('style'=>'display: inline-block;'))?>
                    <span class="user-value"><?= $isSystem && !$admin ? Yii::t('main','Системное сообщение') : $model->userFrom->name?></span>
                </div>
            <?else:?>
                <div class="row">
                    <?=CHtml::label('Кому', 'description',array('style'=>'display: inline-block;'))?>
                    <span class="user-value"><?=$isSystem && !$admin ? Yii::t('main','Администратор сайта') : $model->userTo->name?></span>
                </div>
            <?endif;?>
            <?php if($model->project):?>
                <?=Yii::t('main','Сообщение по проекту "{project}"',array('{project}'=>$model->project->name))?><br/><br/>
            <?php endif;?>
            <div class="row">
                <?=CHtml::textArea('text_message', $model->text, array('class' => 'message-textarea','readonly'=>true))?>
            </div>
            <div id="file-list">
                <?=MessageController::drawFileList($model->files)?>
            </div>
            <?php if(!$isSystem && !$model->isDeletedForYou() || $admin):?>
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
                    <?=$this->renderPartial('application.views.message._upload',array('model'=>$model))?>
                    <?=CHtml::submitButton(Yii::t('main','Отправить'),array('class'=>"btn pull-right"))?>
                </div>
                <div id="document_block">

                </div>
            <?php endif;?>

        </div>
        <div class="clear"></div>
    </div>
    <?=$form->hiddenField($answer,'user_to')?>
<?php if($admin && !empty($model->project_id)):?>
    <?= CHtml::hiddenField('Message[project_id]',$model->project_id)?>
<?php endif;?>
<?php if($admin && !empty($model->admin_type)):?>
    <?= CHtml::hiddenField('Message[admin_type]',$model->admin_type)?>
<?php endif;?>
<?php $this->endWidget(); ?>