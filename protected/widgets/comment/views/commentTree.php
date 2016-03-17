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
        'class'=>'comment-widget comment-block'
    )
)); ?>

<?php endif;?>

    <div id="content-comment">
    <p class="comment-block__title"><?= Yii::t('main','Комментарии')?></p>
    <?if(!Yii::app()->user->isGuest):?>
        <a class="comment-block__link-down" href="#add-comment">
            <i class="icon icon-comment"></i>
            <span><?= Yii::t('main','Комментировать')?></span>
        </a>
    <?endif;?>

        <?foreach($this->tree as $comment):?>
            <div class="comment-tree comments">
                <div class="comment-wrap">
                    <?$this->render('_comment',array('comment'=>$comment['parent']))?>
                    <div class="comment-asw">
                        <?if(isset($comment['child']) && is_array($comment['child'])):?>
                            <div class="child">
                                <? foreach($comment['child'] as $child):?>
                                    <?$this->render('_comment',array('comment'=>$child,'tree'=>$comment['parent']))?>
                                <?endforeach;?>
                            </div>
                        <?endif;?>
                    </div>

                </div>
            </div>
        <?endforeach;?>
        <?if(count($this->tree)==0):?>
            <p class="comment-add-form__title" style="margin:10px 0;"><?=Yii::t('main','Комментарии отсутствуют');?></p>
        <?endif;?>
    </div>

<?if(!$this->reload):?>
    <?if(!Yii::app()->user->isGuest):?>
        <?$currentUser = User::model()->findByPk(Yii::app()->user->id)?>
        <div class="comment-add">
            <div class="comment-add__avatar">
                <?= $currentUser->getAvatar()?>
            </div>
            <div class="comment-add-form clear-fix" id="add-comment">
                <p class="comment-add-form__title"><?= Yii::t('main','Добавить комментарии')?></p>
                <div class="comment-add-f-wrap">
                    <?=CHtml::textArea('Comment[text]','',array('id'=>'comment-write','class'=>'comment-add__field comment-write autosize crud','placeholder'=>Yii::t('main','Текст комментария')))?>
                </div>
                <?=CHtml::submitButton('Отправить',array('class'=>'btn comment-new blue-btn comment-add__btn'))?>
            </div>
        </div>
        <?if(count($this->tree)!=0):?>
            <div class="center">
                <span id="show-more-comment" data-page="0" class="comment-block__view-add"><?=Yii::t('main','Показать ещё');?></span>
            </div><!--center-->
        <?endif;?>

    <?endif?>
    <?php echo CHtml::hiddenField('Comment[type]',$this->objectType)?>
    <?php echo CHtml::hiddenField('Comment[object_id]',$this->objectId)?>
    <?php echo CHtml::hiddenField('Comment[parent_id]','',array('id'=>'Comment_parent_id'))?>
    <?php echo CHtml::hiddenField('',Yii::app()->user->id,array('id'=>'current_user_id'))?>

<?php $this->endWidget(); ?>
<?php endif;?>