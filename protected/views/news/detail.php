<?if($model->is_parsed):?>
<style>
    .full-text .contentheading,
    .full-text .createdate{
        display: none;
    }
</style>
<?endif?>
<div class="news-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns">
            <div class="full-column">
                <div class="news-item opacity-box">
                    <div class="data">
                        <div class="name"><span class="date"><?=Candy::formatDate($model->create_date)?></span> <?=CHtml::encode($model->name)?></div>
                        <div class="announce">
                            <i><?=CHtml::encode($model->announce)?></i>
                        </div>
                        <?=$model->media?Candy::preview(array($model->media, 'scale' => '960x400', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>
                        <?if($model->media && !empty($model->image_notice)):?>
                            <div class="image-notice"><?=CHtml::encode($model->image_notice)?></div>
                        <?endif?>
                        <div class="full-text">
                            <?=$model->full_text?>
                            <? //=$model->is_parsed ? $model->full_text : CHtml::encode($model->full_text)?>
                        </div>
                        <?if(!empty($model->tags)):?>
                            <div class="tags">
                                <b>Теги:</b>
                                <?foreach(explode(',', $model->tags) as $tag):?>
                                <?=CHtml::link(CHtml::encode(trim($tag)), $this->createUrl('news/index', array('tag'=>trim($tag))))?>
                                <?endforeach?>
                            </div>
                        <?endif?>
                        <?if(!empty($model->source_url)):?>
                            <div class="source">
                                <b>Источник:</b>
                                <?=CHtml::link($model->source_url, $model->source_url)?>
                            </div>
                        <?endif?>
                    </div>
                    <? $this->widget('application.widgets.comment.CommentWidget',array('objectType' => 'news', 'objectId'=>$model->id));?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>