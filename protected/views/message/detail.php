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

<div class="padding-md">
    <div class="chat-panel panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
            Ответить
        </div>
        <div class="panel-heading">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'message-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class' => 'form-group'),
                'action'=>$this->createUrl($admin ? 'adminMessages/create' : 'message/create')
            )); ?>
                <?php if(!$isSystem && !$model->isDeletedForYou() || $admin):?>
                    <div class="hidden">
                    <?=$form->textField($answer,'subject',array('class'=>'form-control', 'placeholder' => 'Заголовок'))?>
                    <?=Candy::error($answer,'subject')?>
                    <br>
                    </div>
                    <?=$form->textArea($answer, 'text', array('class' => 'form-control reply-message-textarea', 'placeholder' => 'Текст'))?>
                    <?=Candy::error($answer,'text')?>
                    <br>
                    <div class="button-panel">
                        <?=$this->renderPartial('application.views.message._uploadBootstrap',array('model'=>$model))?>
                        <br>
                        <?=CHtml::submitButton(Yii::t('main','Отправить'),array('class'=>"btn"))?>
                    </div>
                    <div id="document_block">

                    </div>
                <?php endif;?>
                <?=$form->hiddenField($answer,'user_to')?>
                <?=$form->hiddenField($answer,'dialog_id')?>
                <?php if(!empty($model->project_id)):?>
                    <?= CHtml::hiddenField('Message[project_id]',$model->project_id)?>
                <?php endif;?>
                <?php if(!empty($model->admin_type)):?>
                    <?= CHtml::hiddenField('Message[admin_type]',$model->admin_type)?>
                <?php endif;?>

                        <div class="form-group">
                            <? //= CHtml::submitButton('Send', ['class' => 'btn btn-success']) ?>
                        </div>
            <?php $this->endWidget(); ?>
        </div>
            <!-- /.panel-body -->
    </div>
    <div class="chat-message">
        <ul class="chat">
            <?=CHtml::hiddenField('',$time, array('id' => 'update-ajax-time'));?>
            <div id="new-ajax-message"></div>
            <?$this->renderPartial('_messages', array('models' => $models))?>
        </ul>
    </div>
</div>