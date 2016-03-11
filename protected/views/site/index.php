<? Yii::app()->clientScript->registerScript('init', 'indexPart.init();', CClientScript::POS_READY); ?>
<section class="main-nav bg-full-width grey-bg">
    <div class="content">
        <a class="main-nav-link" href="<?=$this->createUrl('investor/index')?>">
            <span class="main-nav-link__icon-wrap">
                <i class="icon icon-main-nav-1 pos-center"></i>
            </span>
            <span class="main-nav-link__name"><?=Yii::t('main','Инвесторы')?></span>
        </a>

        <a class="main-nav-link" href="<?=$this->createUrl('project/index')?>">
            <span class="main-nav-link__icon-wrap">
                <i class="icon icon-main-nav-2 pos-center"></i>
            </span>
            <span class="main-nav-link__name"><?=Yii::t('main','Проекты')?></span>
        </a>

        <a class="main-nav-link" href="<?=$this->createUrl('region/social')?>">
            <span class="main-nav-link__icon-wrap">
                <i class="icon icon-main-nav-3 pos-center"></i>
            </span>
            <span class="main-nav-link__name"><?=Yii::t('main','Регионы')?></span>
        </a>

        <a class="main-nav-link" href="<?=$this->createUrl('law/index')?>">
            <span class="main-nav-link__icon-wrap">
                <i class="icon icon-main-nav-4 pos-center"></i>
            </span>
            <span class="main-nav-link__name"><?=Yii::t('main','Законодательство')?></span>
        </a>

        <a class="main-nav-link" href="<?=$this->createUrl('site/AnalyticsAndNews')?>">
            <span class="main-nav-link__icon-wrap">
                <i class="icon icon-main-nav-5 pos-center"></i>
            </span>
            <span class="main-nav-link__name"><?=Yii::t('main','Аналитика и новости')?></span>
        </a>

        <a class="main-nav-link" href="<?=$this->createUrl('library/index')?>">
            <span class="main-nav-link__icon-wrap">
                <i class="icon icon-main-nav-6 pos-center"></i>
            </span>
            <span class="main-nav-link__name"><?=Yii::t('main','Библиотека')?></span>
        </a>

    </div><!--content-->

</section><!--main-nav-->

<section class="map-wrap content">
    <?php $this->widget('Map', array(
        'id'=>'map',
        'target'=>$this->region->name,
        'region' => $this->region,
        'htmlOptions'=>array(
            'style'=>'height:300px;'
        ),
        'showProjectBalloon'=>true,
        'projects' => Project::model()->findAllByAttributes(array('status' => 'approved', 'region_id' => $this->region->id)),
    )); ?>
</section><!--map-wrap-->

<section class="sec-nav content">
    <div class="sec-nav-wrap">
        <a class="sec-nav-link" href="#">
            <span class="sec-nav-link__icon-wrap">
                <i class="icon icon-sec-nav-1 pos-center"></i>
            </span>
            <span class="sec-nav-link__name">
                Инвестиционный <br/>
                проект
            </span>
        </a>
        <a class="sec-nav-link" href="#">
            <span class="sec-nav-link__icon-wrap">
                <i class="icon icon-sec-nav-2 pos-center"></i>
            </span>
            <span class="sec-nav-link__name">
                Инфраструктурный <br/>
                проект
            </span>
        </a>
        <a class="sec-nav-link" href="#">
            <span class="sec-nav-link__icon-wrap">
                <i class="icon icon-sec-nav-3 pos-center"></i>
            </span>
            <span class="sec-nav-link__name">
                Инновационный <br/>
                проект
            </span>
        </a>
        <a class="sec-nav-link" href="#">
            <span class="sec-nav-link__icon-wrap">
                <i class="icon icon-sec-nav-4 pos-center"></i>
            </span>
            <span class="sec-nav-link__name">
                Продажа <br/>
                бизнеса
            </span>
        </a>
        <a class="sec-nav-link" href="#">
            <span class="sec-nav-link__icon-wrap">
                <i class="icon icon-sec-nav-5 pos-center"></i>
            </span>
            <span class="sec-nav-link__name">
                Инвестиционная <br/>
                площадка
            </span>
        </a>

    </div><!--sec-nav-wrap-->

</section><!--sec-nav-->

<section class="promo content clear-fix">
    <div class="promo-slider">
        <ul class="promo-slides">
            <?$slider = Slider::getSlide();?>
            <?php if(count($slider)):?>
                <?php foreach($slider as $slide):?>
                    <li class="promo-slide">
                        <?=empty($slide->url)? Candy::preview(array($slide->media,'scale'=>'672x418', 'upScale' => '1', 'class' => 'promo-slide__bg')) :
                            CHtml::link(Candy::preview(array($slide->media,'scale'=>'672x418', 'upScale' => '1', 'class' => 'promo-slide__bg')), $slide->url, array('target'=>"_blank"))?>
                        <!--p class="promo-slide__count"></p>
                        <p class="promo-slide__desc"><span></span></p-->
                    </li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>

        <div class="promo-slider-listing slider-listing">
            <span class="promo-slider-listing__prev slider-listing__prev">
                <i></i>
            </span>
            <span class="promo-slider-listing__next slider-listing__next">
                <i></i>
            </span>
        </div><!--promo-slider-listing-->

        <div class="promo-slider-pager">
            <?php if(count($slider)):?>
                <?php $i = 0; foreach($slider as $slide):?>
                    <a class="promo-slider-pager__link <?=$i == 0 ? 'active' : ''?>" href="#" data-slide-index="<?=$i++;?>"></a>
                <?php endforeach;?>
            <?php endif;?>
        </div><!--promo-slider-pager-->

    </div><!--promo-slider-->

    <div class="chart">
        <div id="chart-wrap" style="z-index: 1;">
            <div id="chart" style="z-index: 1;">
                <?php echo $this->renderPartial('../../extensions/informer/index'); ?>
                <?//$this->widget('application.components.Stock.StockWidget')?>
            </div>
        </div>
    </div><!--chart-->

</section>

<section class="content">
    <?=StaticBanner::draw(StaticBanner::MAIN_PAGE_LONG)?>
</section><!--investments-->

<section class="main content">
    <div class="events">
        <div class="events-wrapper">
            <?$this->widget('application.widgets.eventCalendar.EventCalendarWidget',array());?>
        </div>
        <div class="banner">
            <?=StaticBanner::draw(StaticBanner::MAIN_PAGE_NEWS)?>
        </div><!--banner-->
    </div><!--events-->

    <div class="articles articles_right">
        <?$articleNum = 0;?>
        <?if(isset($articles[$articleNum]) && ($model = Candy::getIndexItem($articles[$articleNum]))):?>
            <?$excluded[$articles[$articleNum]['object']][] = $articles[$articleNum]['id'];?>
            <div class="articles-item articles-item_half articles-item_half_mr">
                <span class="articles-item__tag articles-item__tag_top articles-item__tag_<?=$articles[$articleNum]['object']?>"><?= $model->getLabel()?></span>
                <?=$model->media?Candy::preview(array($model->media, 'scale' => '311x145', 'upScale' => '1')):''?>
                <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview'))?>
            </div><!--articles-item-->
        <?endif?>

        <?if(isset($articles[++$articleNum]) && ($model = Candy::getIndexItem($articles[$articleNum]))):?>
            <?$excluded[$articles[$articleNum]['object']][] = $articles[$articleNum]['id'];?>
            <div class="articles-item articles-item_half articles-item_half_big">
                <span class="articles-item__tag articles-item__tag_top articles-item__tag_<?=$articles[$articleNum]['object']?>"><?= $model->getLabel()?></span>
                <?=$model->media?Candy::preview(array($model->media, 'scale' => '311x145', 'upScale' => '1')):''?>
                <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview'))?>
            </div><!--articles-item-->
        <?endif?>

        <?if(isset($mainArticles[0]) && ($model = Candy::getIndexItem($mainArticles[0]))):?>
            <div class="articles-item articles-item_big">
                <?=$model->media?Candy::preview(array($model->media, 'scale' => '639x290', 'upScale' => '1')):''?>
                <span class="articles-item__tag articles-item__tag_<?=$mainArticles[0]['object']?>"><?= $model->getLabel()?></span>
                <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview'))?>
            </div><!--articles-item-->
        <?endif?>
    </div><!--articles-->

    <div class="articles clear-fix">
        <div class="articles-col_small">
            <?$skipLast = 0;?>
            <?if(isset($articles[++$articleNum]) && ($model = Candy::getIndexItem($articles[$articleNum]))):?>
                <?$excluded[$articles[$articleNum]['object']][] = $articles[$articleNum]['id'];?>
                <?$skipLast += $model->media ? 1 : 0?>
                <div class="articles-item">
                    <?=$model->media?Candy::preview(array($model->media, 'scale' => '304x145', 'upScale' => '1')):''?>
                    <span class="articles-item__tag articles-item__tag_<?=$articles[$articleNum]['object']?>"><?=$model->getLabel()?></span>
                    <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                    <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview'))?>
                    <p class="articles-item__text"><?=$model->announce?></p>
                </div><!--articles-item-->
            <?endif?>
            <?if(isset($articles[++$articleNum]) && ($model = Candy::getIndexItem($articles[$articleNum]))):?>
                <?$excluded[$articles[$articleNum]['object']][] = $articles[$articleNum]['id'];?>
                <?$skipLast += $model->media ? 1 : 0?>
                <div class="articles-item">
                    <?=$model->media?Candy::preview(array($model->media, 'scale' => '304x145', 'upScale' => '1')):''?>
                    <span class="articles-item__tag articles-item__tag_<?=$articles[$articleNum]['object']?>"><?=$model->getLabel()?></span>
                    <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                    <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview'))?>
                    <p class="articles-item__text"><?=$model->announce?></p>
                </div><!--articles-item-->
            <?endif?>
            <?if ($skipLast < 2):?>
                <?if(isset($articles[++$articleNum]) && ($model = Candy::getIndexItem($articles[$articleNum]))):?>
                    <?$excluded[$articles[$articleNum]['object']][] = $articles[$articleNum]['id'];?>
                    <div class="articles-item">
                        <?=$model->media?Candy::preview(array($model->media, 'scale' => '304x145', 'upScale' => '1')):''?>
                        <span class="articles-item__tag articles-item__tag_<?=$articles[$articleNum]['object']?>"><?=$model->getLabel()?></span>
                        <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                        <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview'))?>
                        <p class="articles-item__text"><?=$model->announce?></p>
                    </div><!--articles-item-->
                <?endif?>
            <?endif?>
        </div><!--articles-col-->

        <div class="articles-col">
            <?if(isset($mainArticles[1]) && ($model = Candy::getIndexItem($mainArticles[1]))):?>
                <div class="articles-item articles-item_big articles-item_big_mb">
                    <?=$model->media?Candy::preview(array($model->media, 'scale' => '639x290', 'upScale' => '1')):''?>
                    <span class="articles-item__tag articles-item__tag_<?=$mainArticles[0]['object']?>"><?= $model->getLabel()?></span>
                    <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                    <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview'))?>
                </div><!--articles-item-->
            <?endif?>

            <?if(isset($articles[++$articleNum]) && ($model = Candy::getIndexItem($articles[$articleNum]))):?>
                <?$excluded[$articles[$articleNum]['object']][] = $articles[$articleNum]['id'];?>
                <div class="articles-item articles-item_half articles-item_half_mr articles-item_half_big">
                    <?=$model->media?Candy::preview(array($model->media, 'scale' => '311x145', 'upScale' => '1')):''?>
                    <span class="articles-item__tag articles-item__tag_<?=$articles[$articleNum]['object']?>"><?=$model->getLabel()?></span>
                    <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                    <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview articles-item__preview_small'))?>
                    <p class="articles-item__text"><?=$model->announce?></p>
                </div><!--articles-item-->
            <?endif?>

            <?if(isset($articles[++$articleNum]) && ($model = Candy::getIndexItem($articles[$articleNum]))):?>
                <?$excluded[$articles[$articleNum]['object']][] = $articles[$articleNum]['id'];?>
                <div class="articles-item articles-item_half">
                    <?=$model->media?Candy::preview(array($model->media, 'scale' => '304x145', 'upScale' => '1')):''?>
                    <span class="articles-item__tag articles-item__tag_<?=$articles[$articleNum]['object']?>"><?=$model->getLabel()?></span>
                    <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                    <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview articles-item__preview_small'))?>
                    <p class="articles-item__text"><?=$model->announce?></p>
                </div><!--articles-item-->
            <?endif?>
        </div><!--articles-col-->
        <div class="ajax-more-article"></div>
        <form class="more-btn-wrap" action="<?=$this->createUrl('site/more')?>">
            <?=CHtml::hiddenField('page',0)?>
            <?=CHtml::hiddenField('excluded',json_encode($excluded))?>
            <div id="ajax-load-article" class="red-btn articles__add" data-page="0" style="text-align: center;">Показать еще</div>
        </form>


    </div><!--articles-->

</section><!--main-->