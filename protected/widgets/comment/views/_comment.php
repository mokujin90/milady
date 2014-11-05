<?php
/**
 * @var $comment Comment
 * @var $tree Comment
 * @var $this CommentWidget
 */
?>
<div data-id="<?=$comment->id?>" class="<?=$this->getCommentClass($comment)?>">
    <div class="left-part">
        <div class="avatar">
            <?= $comment->user->getAvatar()?>
        </div>
    </div>
    <div class="right-part">
        <div class="header">
            <span data-user="<?=$comment->user_id?>" class="name"><?= $comment->user->getName()?></span>
        </div>
        <div class="text">
            <?= $comment->text;?>
        </div>
        <div class="notice">
            <span class="date">
                <?= Candy::formatDate($comment->create_date, CommentWidget::DATE_FORMAT)?>
            </span>
            <?if(!is_null($comment->parent_id)):?>
                <span title="<?= Yii::t('main','Выделить родительскую реплику')?>" data-parent="<?= $comment->parent_id?>" class="answer-find">(<?= Yii::t('main','В ответ на комментарий')?> <?=$this->getAnswer($comment,$tree)->user->getName()?>)</span>
            <?endif;?>
            <?if($comment->user_id == Yii::app()->user->id):?>
                <?php echo CHtml::link(Yii::t('main','Удалить'),'#',array('class'=>'delete-comment','data-comment'=>$comment->id))?>
            <?endif;?>
        </div>
    </div>

</div>
