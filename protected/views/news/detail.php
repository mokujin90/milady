<?
/**
 * @var $lastAnalytic Analytics
 * @var $similarNews News[]
 * @var $model News
 * @var $this NewsController
 */
?>
<?php Yii::app()->clientScript->registerScript('init', 'indexPart.initFavorite();', CClientScript::POS_READY);?>

<h2 class="page-title"><?=Yii::t('main','Новости');?></h2>

<div class="page-wrap">
<div class="page-wrap-content">
<div class="article clear-fix">
    <div class="article-top">
        <span class="article__date"><?=Candy::formatDate($model->create_date)?></span>
<!--        <span class="article__author">Автор: Иванов. И. И.</span>-->
        <?if(isset($model->source_url)):?>
            <span class="article__source">Источник: <?=CHtml::link($model->source_url, $model->source_url)?></span>
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
        <ul class="article-slides">
            <li class="article-slide">
                <?=$model->media?Candy::preview(array($model->media, 'scale' => '629x290', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>
            </li>
        </ul>
        <?if($model->media && !empty($model->image_notice)):?>
            <p class="article-slider__desc"><?=CHtml::encode($model->image_notice)?></p>
        <?endif?>

        <?if(false):?>
            <div class="article-slider-listing slider-listing">
            <span class="article-slider-listing__prev slider-listing__prev">
                <i></i>
            </span>
            <span class="article-slider-listing__next slider-listing__next">
                <i></i>
            </span>

            </div><!--article-slider-listing-->
        <?endif;?>


    </div><!--article-slider-->
    <div class="article__desc">
        <?=$model->full_text?>
    </div>


    <?if(!empty($model->tags)):?>
        <div class="article-tags">
            <?foreach(explode(',', $model->tags) as $tag):?>
                <?=CHtml::link(CHtml::encode(trim($tag)), $this->createUrl('news/index', array('tag'=>trim($tag))),array('class'=>'article__tag'))?>
            <?endforeach?>
        </div>
    <?endif?>

    <?if(false):?>
        <div class="page-social">
            <a class="page-social__link page-social__link_vk" href="#">
                <i class="page-social__icon page-social__icon_vk"></i>
                <span class="page-social__count">100</span>
            </a>

            <a class="page-social__link page-social__link_fb" href="#">
                <i class="page-social__icon page-social__icon_fb"></i>
                <span class="page-social__count">100</span>
            </a>

            <a class="page-social__link page-social__link_in" href="#">
                <i class="page-social__icon page-social__icon_in"></i>
                <span class="page-social__count">100</span>
            </a>

        </div><!--page-social-->
    <?endif;?>
    <?if(isset($model->file_id) && $model->file && !empty($model->file_id)):?>
            <a class="article-download" href="<?=$model->file->makeWebPath();?>">
            <i class="icon icon-download"></i>
                    <span class="article-download__desc">
                       <?=(empty($model->file_title) ? 'Прикрепленный документ' : $model->file_title);?>
            </span>
        </a>
    <?endif;?>




</div><!--article-->

<div class="comment-block">
    <? $this->widget('application.widgets.comment.CommentWidget',array('objectType' => $model->tableName()=='News' ? 'news' : 'analytics', 'objectId'=>$model->id));?>

    <?if(false):?>
        <div class="center">
            <span class="comment-block__view-add">Показать ещё</span>
        </div><!--center-->
    <?endif;?>


</div><!--comment-block-->

</div><!--page-wrap-content-->

<aside class="page-wrap-aside">
    <?if($lastAnalytic):?>
    <div class="w-news aside-block">
        <?=$lastAnalytic->media?Candy::preview(array($lastAnalytic->media, 'scale' => '328x203', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>
        <p class="w-news__date"><?=Candy::formatDate($lastAnalytic->create_date,'d/m');?></p>
        <a style="text-decoration: none;" href="<?=$this->createUrl('analytics/detail',array('id'=>$lastAnalytic->id));?>">
            <p class="w-news__desc"><?=$lastAnalytic->announce;?></p>
        </a>

    </div><!--w-news-->
    <?endif;?>

    <div class="aside-block registration">
        <input class="registration__field" type="text" name="registration" placeholder="введите e-mail"/>
        <button class="blue-btn registration__btn">Зарегистрироваться</button>
        <p class="registration__desc">
            Зарегистрируйтесь! <br/>
            Вам будет предоставлена возможность получать
            самые актуальные данные инвест-проектов региона.
        </p>
    </div><!--aside-block-->



    <?if(count($similarNews)>0):?>
        <div class="w-news-list aside-block">
            <p class="w-news-list__title"><?=(empty($model->region_id) ? Yii::t('main','Федеральные новости') : Yii::t('main','Новости региона'));?></p>
            <?foreach($similarNews as $news):?>
                <div class="w-news-item">
                    <?=$news->media?Candy::preview(array($news->media, 'scale' => '80x80', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>

                    <div class="w-news-item-right">
                        <p class="w-news-item__date"><?=Candy::formatDate($news->create_date);?> / <small><?=Candy::formatDate($news->create_date,'H:i');?></small></p>
                        <a class="w-news-item__link" href="<?=$this->createUrl('news/detail',array('id'=>$news->id));?>">
                            <?=$news->announce;?>
                        </a>

                    </div><!--w-news-item-right-->

                </div><!--w-news-item-->
            <?endforeach;?>
        </div><!--w-news-list-->
    <?endif;?>


</aside><!--page-wrap-aside-->

</div><!--page-wrap-->

