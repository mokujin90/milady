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
            <?foreach($models as $item):?>
                <li class="<?=$item->user_from == Yii::app()->user->id ? 'right' : 'left'?> clearfix">
                    <?if($item->user_from == Yii::app()->user->id){?>
                        <span class="chat-img pull-right"><?=Candy::preview(array($item->userFrom->logo, 'scale' => '45x45'))?></span>
                    <?} else {?>
                        <span class="chat-img pull-left"><?=Candy::preview(array($item->userFrom->logo, 'scale' => '45x45'))?></span>
                    <?}?>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <?php if($item->project):?>
                                <?=Yii::t('main','Сообщение по проекту "{project}"',array('{project}'=>$item->project->name))?>
                            <?php endif;?>
                            <strong class="primary-font">
                                <?= CHtml::tag('strong', array(), $item->getFromUserLabel('userFrom'));?>
                            </strong>
                            <small class="pull-right text-muted" style="margin: 0 5px;"><i class="fa fa-calendar fa-fw"></i> <?= $item->create_date?></small>
                        </div>
                        <p></p>
                        <?if($item->user_from && !$item->admin_type):?>
                            <?=CHtml::tag('div', array('class' => 'system message-textarea'), nl2br(trim(CHtml::encode($item->text))))?>
                        <?else:?>
                            <?=CHtml::tag('div', array('class' => 'system message-textarea'), $item->text)?>
                        <?endif?>
                        <div id="file-list">
                            <?=MessageController::drawFileList($item->files)?>
                        </div>
                        <div class="clear"></div>

                    </div>
                </li>
            <?endforeach?>
        </ul>
    </div>
</div>