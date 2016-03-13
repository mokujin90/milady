<?php
/**
 * @var $comment Comment
 * @var $tree Comment
 * @var $this CommentWidget
 */
?>
<div id="<?=$this->getCommentId($comment->id)?>" data-id="<?=$comment->id?>" class="<?=$this->getCommentClass($comment)?> comment">
    <div class="comment__avatar">
        <?= $comment->user->getAvatar()?>
    </div>
    <div class="comment-right right-part">
        <div class="comment-top header">
            <?if(!is_null($comment->parent_id)):?>
                <a href="#<?=$this->getCommentId($comment->parent_id)?>" title="<?= Yii::t('main','Выделить родительскую реплику')?>" data-parent="<?= $comment->parent_id?>" class="name comment__asw-prev-btn"><?= $comment->user->getName()?></a>
            <?else:?>
                <span data-user="<?=$comment->user_id?>" class="name comment__user-name"><?= $comment->user->getName()?></span>
            <?endif;?>
            <span class="date comment__date"><?= Candy::formatDate($comment->create_date, CommentWidget::DATE_FORMAT)?> / <small><?= Candy::formatDate($comment->create_date, CommentWidget::TIME_FORMAT)?></small></span>

        </div><!--comment-top-->

        <p class="comment__text text">
            <?= $comment->text;?>
        </p>
        <?if($comment->user_id != Yii::app()->user->id && !Yii::app()->user->isGuest):?>
            <?= CHtml::link(Yii::t('main','Ответить'),'#',array('class'=>'comment__asw-btn new-answer'))?>
        <?endif;?>
        <?if($comment->user_id == Yii::app()->user->id):?>
            <?php echo CHtml::link(Yii::t('main','Удалить'),'#',array('class'=>'delete-comment comment__asw-btn','data-comment'=>$comment->id))?>
        <?endif;?>

    </div>
</div>
