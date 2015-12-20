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
Yii::app()->clientScript->registerScript('init', 'messagePart.init();', CClientScript::POS_READY);

?>
<style>
    .overlay.sending {
        background: rgba(0,0,0,0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 100;
        border-radius: 2px;
    }
    #wrapper, #main-container {
        min-height: 400px !important;
    }
    #breadcrumb {
        position: fixed;
        width: 100%;
        z-index: 1;
        background: #f9f9f9;
    }
    .panel-tab {
        position: fixed;
        width: 100%;
        margin-top: 39px;
        z-index: 1;
    }
    .headline{
        position: fixed;
        margin-top: 76px;
        padding: 10px 15px 10px 10px;
        width: 100%;
        z-index: 1;
        background: #FFF;
    }
</style>
<div class="padding-md">
    <?if($dialog->type == 'project' && empty($_COOKIE['deal_help_hide'])):?>
        <div class="alert alert-danger hide-wrapper" style="position: relative;">
            Портал оказывает услугу сопровождение сделки
            <div class="refresh-button hide-block" data-cookie="deal_help_hide">
                <i class="fa fa-close"></i>
            </div>
        </div>
    <?endif?>

    <div class="chat-message" style="padding-bottom: 120px;">
        <ul class="chat">
            <?=CHtml::hiddenField('',$model->create_date, array('id' => 'update-ajax-time'));?>
            <?$this->renderPartial('_messages', array('models' => $models))?>
            <div id="new-ajax-message"></div>
        </ul>
        <?if($dialog->type == 'project') :?>
            <? $deal = $dialog->getDialForm();?>
            <?if(!is_null($deal)):?>
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'deal-form',
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class' => 'form-group'),
                    'action'=>$this->createUrl('message/deal')
                )); ?>
                <div class="alert alert-info margin-sm">
                    <?=$deal['text']?>
                    <div class="pull-right" style="margin-top: -2px;">
                        <?foreach($deal['action'] as $action => $text) {
                            echo CHtml::tag('button', array('class'=>"btn btn-xs btn-success", 'value' => $action, 'name' => 'action_id', 'type' => 'submit'), $text);
                        }?>
                    </div>
                </div>

                <?=CHtml::hiddenField('dialog_id', $dialog->id)?>
                <?php $this->endWidget(); ?>
            <?endif?>
        <?endif?>
    </div>

    <div class="chat-panel panel panel-default fixed-chat-panel" style="padding-right:0;">
        <div class="overlay sending hidden"></div>
        <div class="panel-heading">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'message-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class' => 'form-group'),
                'action'=>$this->createUrl('adminMessages/create')
            )); ?>
            <div class="hidden">
                <?=$form->textField($answer,'subject',array('class'=>'form-control', 'placeholder' => 'Заголовок'))?>
                <?=Candy::error($answer,'subject')?>
                <br>
            </div>
            <?=$form->textArea($answer, 'text', array('style' => 'resize: none;', 'class' => 'form-control reply-message-textarea', 'placeholder' => 'Текст'))?>
            <?=Candy::error($answer,'text')?>
            <br>
            <div class="button-panel">
                <?=CHtml::ajaxSubmitButton(Yii::t('main','Отправить'), $this->createUrl('adminMessages/create'), array('success' => 'messagePart.successAjax'),array('class'=>"btn pull-right", 'onclick' => '$(".overlay.sending").removeClass("hidden");'));?>
                <?if($dialog->type != 'feedback'){?>
                <?=$this->renderPartial('application.views.message._uploadBootstrap',array('model'=>$model))?>
                <div id="document_block">

                </div>
                <?}else{?>
                    <br>
                <?}?>
            </div>

            <?=$form->hiddenField($answer,'user_to')?>
            <?=$form->hiddenField($answer,'dialog_id')?>
            <?php if(!empty($model->project_id)):?>
                <?= CHtml::hiddenField('Message[project_id]',$model->project_id)?>
            <?php endif;?>
            <?php if(!empty($model->admin_type)):?>
                <?= CHtml::hiddenField('Message[admin_type]',$model->admin_type)?>
            <?php endif;?>
            <?php if($answer->dialog && $answer->dialog->type == 'feedback'):?>
                <?= CHtml::hiddenField('message_feedback','feedback')?>
            <?php endif;?>

            <?php $this->endWidget(); ?>
        </div>
        <!-- /.panel-body -->
    </div>

</div>

