<?
/**
 * @var $this MessageController
 * @var $model Message
 * @var $form CActiveForm
 * @var $systemType bool
 * @var $params array
 */
$admin = Candy::get($admin,false);
Yii::app()->clientScript->registerScript('init', 'messagePart.init();', CClientScript::POS_READY);

?>
<style>
    #wrapper, #main-container {
        min-height: 400px !important;
    }
</style>
<div class="padding-md">
    <div class="chat-panel panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
            Напишите сообщение
        </div>
        <div class="panel-heading">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'message-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class' => 'form-group'),
                'action'=>$this->createUrl($admin ? 'adminMessages/create' : Yii::app()->request->url)
            )); ?>

            <?php if($model->project):?>
                <br/><?=Yii::t('main','Сообщение по проекту "{project}"',array('{project}'=>$model->project->name))?>
            <?php endif;?>
            <?if($systemType):?>
                <?=CHtml::textField('Message[user_to_name]',Yii::t('main','Администратор сайта'),array('class'=>'user-value no form-control','blocked'=>true, 'readonly' => 'readonly'))?>
            <?else:?>
                <?if($model->project_id):?>
                    <?=CHtml::textField('Message[user_to_name]',isset($params['user_to_name']) ? $params['user_to_name'] : '',array('class'=>'user-value no form-control','blocked'=>true))?>
                <?else:?>
                    <?=CHtml::textField('Message[user_to_name]',isset($params['user_to_name']) ? $params['user_to_name'] : '',array('class'=>'autocomplete form-control user-value no','placeholder'=>Yii::t('main','Введите пользователя')))?>
                <?endif;?>
                <?=$form->hiddenField($model,'user_to',array('class'=>'','id'=>'Message_user_to'))?>
            <?endif;?>
            <?=$form->error($model,'user_to')?>
            <br>
            <div class="hidden">
            <?=$form->textField($model,'subject',array('class'=>'form-control', 'placeholder' => 'Заголовок'))?>
            <?=Candy::error($model,'subject')?>
            <br>
            </div>
            <?=$form->textArea($model, 'text', array('class' => 'form-control reply-message-textarea', 'placeholder' => 'Текст'))?>
            <?=Candy::error($model,'text')?>
            <br>
            <div class="button-panel">
                <?=$this->renderPartial('application.views.message._uploadBootstrap',array('model'=>$model))?>
                <br>
                <?=CHtml::submitButton(Yii::t('main','Отправить'),array('class'=>"btn"))?>
            </div>
            <div id="document_block">

            </div>
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
</div>