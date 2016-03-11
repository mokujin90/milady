<?
if($article['object']=='news'){
    $caption = empty($model->region_id) ? Yii::t('main','Федеральные новости') : Yii::t('main','Новости региона');
}
elseif($article['object'] == 'analytics'){
    $caption = Yii::t('main','Аналитика');
}
elseif($article['object'] == 'event'){
    $caption = Yii::t('main','События');
}
?>

<div class="news">
    <span class="news__type"><?=$caption;?></span>
    <div class="news__photo">
        <?=$model->media ? Candy::preview(array($model->media, 'scale' => '305x203', 'class' => 'image')):''?>
    </div><!--news__photo-->
    <p class="news__date"><?=Candy::formatDate($model->create_date,'d/m/Y')?></p>
    <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(), array('class' => 'news__link'))?>

    <p class="news__desc">
        <?=CHtml::encode($model->announce)?>
    </p>
    <?if(!empty($model->tags)):?>
        <div class="news-tags">
            <?foreach(explode(',', $model->tags) as $tag):?>
                <?=CHtml::link(CHtml::encode(trim($tag)), $this->createUrl('news/index', array('tag'=>trim($tag))),array('class'=>'news__tag'))?>
            <?endforeach?>
        </div>
    <?endif?>
</div>