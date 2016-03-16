<?
/**
 * @var $lastAnalytic Analytics
 * @var $similarNews News[]
 * @var $model News
 * @var $this NewsController
 */
?>
<?php Yii::app()->clientScript->registerScript('init', 'indexPart.initFavorite();', CClientScript::POS_READY);?>
<?php Yii::app()->clientScript->registerScript('init', 'newsPart.detail();', CClientScript::POS_READY);?>

<h2 class="page-title"><?=!empty($title) ? $title : Yii::t('main','Новости');?></h2>

<div class="page-wrap">
<div class="page-wrap-content">
    <div class="article clear-fix">
    <div class="article-top">
        <span class="article__date"><?=Candy::formatDate($model->create_date,Candy::NORMAL)?></span>
<!--        <span class="article__author">Автор: Иванов. И. И.</span>-->
        <?if(!empty($model->source_url)):?>
            <?$parseUrl = parse_url($model->source_url);?>
            <?if(isset($parseUrl['host'])):?>
                <span class="article__source"><?=Yii::t('main','Источник');?>: <?=CHtml::link($parseUrl['host'], $model->source_url)?></span>
            <?endif;?>
        <?endif;?>

        <?if(isset($model->category)):?>
            <span class="article__categories"><?=Yii::t('main','Категория');?>: <?=Analytics::getCategoryType($model->category);?></span>
        <?endif;?>


    </div><!--article-top-->

    <h3 class="article__title">
        <?=CHtml::encode($model->name)?>
    </h3>

    <p class="article__desc">
        <?=CHtml::encode($model->announce)?>
    </p>

    <div class="article-slider">
        <?if(count($slider)>1){?>
            <div class="article-slider">
                <ul class="article-slides">
                    <?foreach($slider as $slide):?>
                        <li class="article-slide">
                            <?=Candy::preview(array($slide, 'scale' => '629x290', 'class' => 'image-block center', 'upScale' => 1))?>
                        </li>
                    <?endforeach;?>

                </ul>
                <?if($model->media && !empty($model->image_notice)):?>
                    <p class="article-slider__desc"><?=CHtml::encode($model->image_notice)?></p>
                <?endif?>
                <div class="article-slider-listing slider-listing">
                        <span class="article-slider-listing__prev slider-listing__prev">
                            <i></i>
                        </span>
                        <span class="article-slider-listing__next slider-listing__next">
                            <i></i>
                        </span>

                </div><!--article-slider-listing-->

            </div><!--article-slider-->
        <?} elseif(count($slider)) {?>
            <?=Candy::preview(array($slider[0], 'scale' => '629x290', 'class' => 'image-block center', 'upScale' => 1))?>
        <?}?>
    </div><!--article-slider-->
    <div class="article__desc">
        <?=$model->full_text?>
    </div>


    <?if(!empty($model->tags)):?>
        <div class="article-tags">
            <?foreach(explode(',', $model->tags) as $tag):?>
                <?=CHtml::link(CHtml::encode(trim($tag)), '#',/*$this->createUrl('news/index', array('tag'=>trim($tag))),*/array('class'=>'article__tag'))?>
            <?endforeach?>
        </div>
    <?endif?>

    <?$this->renderPartial('/partial/_social',array('title'=>$model->name,'description'=>$model->announce,'img'=>isset($model->media) ? $model->media->makeWebPath() : ''))?>
    <?if(isset($model->file_id) && $model->file && !empty($model->file_id)):?>
            <a class="article-download" href="<?=$model->file->makeWebPath();?>">
            <i class="icon icon-download"></i>
                    <span class="article-download__desc">
                       <?=(empty($model->file_title) ? 'Прикрепленный документ' : $model->file_title);?>
            </span>
        </a>
    <?endif;?>
</div>
<? $this->widget('application.widgets.comment.CommentWidget',array('objectType' => $model->tableName()=='News' ? 'news' : 'analytics', 'objectId'=>$model->id));?>

</div>
<!--page-wrap-content-->

<aside class="page-wrap-aside">
    <?if($lastAnalytic):?>
    <div class="w-news aside-block">
        <?=$lastAnalytic->media?Candy::preview(array($lastAnalytic->media, 'scale' => '328x203', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>
        <p class="w-news__date"><?=Candy::formatDate($lastAnalytic->create_date,'d/m');?></p>
        <a style="text-decoration: none;" href="<?=$this->createUrl('analytics/detail',array('id'=>$lastAnalytic->id));?>">
            <p class="w-news__desc"><?=$lastAnalytic->name;?></p>
        </a>

    </div><!--w-news-->
    <?endif;?>

    <?$this->renderPartial('../partial/_register')?>


    <?if(count($similarNews)>0):?>
        <div class="w-news-list aside-block">
            <p class="w-news-list__title"><?=(empty($model->region_id) ? Yii::t('main','Федеральные новости') : Yii::t('main','Новости региона'));?></p>
            <?foreach($similarNews as $news):?>
                <div class="w-news-item">
                    <?=$news->media?Candy::preview(array($news->media, 'scale' => '80x80', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>

                    <div class="w-news-item-right">
                        <p class="w-news-item__date"><?=Candy::formatDate($news->create_date);?> / <small><?=Candy::formatDate($news->create_date,'H:i');?></small></p>
                        <a class="w-news-item__link" href="<?=$this->createUrl('news/detail',array('id'=>$news->id));?>">
                            <?=$news->name;?>
                        </a>

                    </div><!--w-news-item-right-->

                </div><!--w-news-item-->
            <?endforeach;?>
        </div><!--w-news-list-->
    <?endif;?>


</aside><!--page-wrap-aside-->

</div><!--page-wrap-->

