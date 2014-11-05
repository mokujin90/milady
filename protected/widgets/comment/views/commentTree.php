<?php
/**
 *
 * @var CommentWidget $this
 */
?>
<? if(!$this->reload):?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>false,
    'action'=>$this->owner->createUrl('comment/create'),
    'htmlOptions'=>array(
        'class'=>'comment-widget'
    )
)); ?>
<?php endif;?>
    <div id="content-comment">
        <?php if(count($this->tree)==0):?>
            <div class="error"><?= Yii::t('main','На данный момент нет ни одного комментария.')?></div>
        <?php endif;?>
        <?foreach($this->tree as $comment):?>
            <div class="comment-tree">
                <?$this->render('_comment',array('comment'=>$comment['parent']))?>
                <?if(isset($comment['child']) && is_array($comment['child'])):?>
                    <div class="child">
                        <? foreach($comment['child'] as $child):?>
                            <?$this->render('_comment',array('comment'=>$child,'tree'=>$comment['parent']))?>
                        <?endforeach;?>
                    </div>
                <?endif;?>
            </div>
        <?endforeach;?>
    </div>
<? if(!$this->reload):?>
    <div class="write">
        <?=CHtml::textArea('Comment[text]','',array('id'=>'comment-write','class'=>'comment-write autosize crud','placeholder'=>Yii::t('main','Текст комментария')))?>
        <?=CHtml::submitButton('Комментировать',array('class'=>'btn comment-new'))?>
    </div>
    <?php echo CHtml::hiddenField('Comment[type]',$this->objectType)?>
    <?php echo CHtml::hiddenField('Comment[object_id]',$this->objectId)?>
    <?php echo CHtml::hiddenField('Comment[parent_id]','',array('id'=>'Comment_parent_id'))?>
    <?php echo CHtml::hiddenField('',Yii::app()->user->id,array('id'=>'current_user_id'))?>


<?php $this->endWidget(); ?>
<?php endif;?>