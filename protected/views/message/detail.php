<?
/**
 * @var $this MessageController
 * @var $model Message
 * @var $answer Message
 * @var $form CActiveForm
 */
$admin = Candy::get($admin,false);
$action = Yii::app()->controller->action->id;
$isSystem = is_null($model->user_from && $model->admin_type!=null) || is_null($model->user_to);
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
                    <?if($admin):?>
                        <?=CHtml::link($model->getFromUserLabel('userFrom'),array('adminUser/history','id'=>$model->user_from),array('class'=>'user-value'))?>
                    <?else:?>
                        <span class="user-value"><?=$model->getFromUserLabel('userFrom')?></span>
                    <?endif;?>

                </div>
            <?else:?>
                <div class="row">
                    <?=CHtml::label('Кому', 'description',array('style'=>'display: inline-block;'))?>
                    <span class="user-value"><?=$model->getFromUserLabel('userTo')?></span>
                </div>
            <?endif;?>
            <?php if($model->project):?>
                <?=Yii::t('main','Сообщение по проекту "{project}"',array('{project}'=>$model->project->name))?><br/><br/>
            <?php endif;?>
            <div class="row">
                <?if($model->user_from && !$model->admin_type):?>
                    <?=CHtml::textArea('text_message', $model->text, array('class' => 'message-textarea','readonly'=>true))?>
                <?else:?>
                    <?=CHtml::tag('div', array('class' => 'system message-textarea'), $model->text)?>
                <?endif?>
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
<?php if(!empty($model->project_id)):?>
    <?= CHtml::hiddenField('Message[project_id]',$model->project_id)?>
<?php endif;?>
<?php if(!empty($model->admin_type)):?>
    <?= CHtml::hiddenField('Message[admin_type]',$model->admin_type)?>
<?php endif;?>
<?php $this->endWidget(); ?>