<?php
/**
 *
 * @var ProjectController $this
 * @var Project $model
 * @var ActiveRecord $content
 * @var array $fields
 */
?>
<div class="abs main ajax-balloon">
    <div class="transparent">
        <div class="type"><?=$model->getProjectType()?></div>
        <a class="header red" href="<?=$model->createUrl()?>"><?=$model->name?></a>
        <div class="create"><?=Candy::formatDate($model->create_date,'d.m.Y H:i:s')?></div>
        <div class="logo">
            <? if(isset($model->logo)):?>
                <?=Candy::preview(array($model->logo,'scale'=>'100x100'))?>
            <? endif;?>
        </div>
        <div class="comments">
            <?php $comments = Comment::model()->countByAttributes(array('type'=>Comment::T_PROJECT,'object_id'=>$model->id))?>
            <i class="icon icon-balloon"><span><?=$comments?></span></i> <?=Candy::getNumEnding($comments,array('комментарий', 'комментария', 'комментариев'))?>
        </div>
        <div class="region">
            <?=$model->region->name?>
        </div>
        <?$allParams = array('investment_sum', 'period', 'profit_norm', 'profit_clear')?>
        <table class="all-params">
            <tbody>
                <?foreach($allParams as $field):?>
                    <tr>
                        <td class="key"><?=$model->getAttributeLabel($field)?></td>
                        <td class="value"><?=$model->{$field}?></td>
                    </tr>
                <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>