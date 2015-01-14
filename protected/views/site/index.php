<?php
/* @var $this SiteController */
    Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.bxslider.css');

    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScript('init', 'indexPart.init();', CClientScript::POS_READY);

?>
<?php if($msg = Yii::app()->user->getFlash('msg')):?>
    <script type="text/javascript">
        $(window).load(function () {
            $.confirmDialog({
                content: '<?=$msg?>',
                confirmText: 'Ок',
                cancelText:false
            });
        });
    </script>
<?php endif;?>
<div class="main-page small-map-popup">
    <?php $this->widget('Map', array(
        'id'=>'map',
        'target'=>$this->region->name,
        'region' => $this->region,
        'htmlOptions'=>array(
            'style'=>'height:300px;'
        ),
        'showProjectBalloon'=>true,
        'projects' => Project::model()->findAll(),
        'panel'=>'application.views.site._filterMap'
    )); ?>
    <div class="dark-gray-gradient line top bottom">
        <div class="main rel">
            <div id="map-up" class="icon icon-slide-up abs"></div>
        </div>
    </div>
    <div class="promo">
        <div class="main chain-block">
            <div id="slider">
                <?$slider = Slider::getSlide();?>
                <?php if(count($slider)):?>
                    <ul class="bxslider">
                        <?php foreach($slider as $slide):?>
                            <li><span class="helper"></span><?=empty($slide->url)? Candy::preview(array($slide->media,'scale'=>'667x419', 'upScale' => '1')) :
                                CHtml::link(Candy::preview(array($slide->media,'scale'=>'667x419', 'upScale' => '1')), $slide->url, array('target'=>"_blank"))?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
            </div>
            <div id="chart-wrap" style="min-height: 430px; float: right; z-index: 1;">
                <div id="chart" style="float: right; z-index: 1;">
                    <?php echo $this->renderPartial('../../extensions/informer/index'); ?>
                    <?//$this->widget('application.components.Stock.StockWidget')?>
                </div>
            </div>
        </div>
    </div>
    <div id="general">
        <div class="main big center">
            <?=StaticBanner::draw(StaticBanner::MAIN_PAGE_LONG)?>
        </div>
        <div class="content main">
            <div class="connected event">
                <?$this->widget('application.widgets.eventCalendar.EventCalendarWidget',array());?>
                <div class="banner display-1000" style="margin-right: 5px;">
                    <?=StaticBanner::draw(StaticBanner::MAIN_PAGE_NEWS)?>
                </div>
            </div>
            <div class="connected news-analytic">
                <?if(count($news)):?>
                <div class="record news">
                    <div class="category"><?= Yii::t('main','Новости')?></div>
                    <a href="<?=$news[0]->createUrl()?>">
                        <?=$news[0]->media?Candy::preview(array($news[0]->media, 'scale' => '304x145', 'class' => 'image')):''?>
                        <?php //echo CHtml::image('/images/assets/news-middle-1.png','',array('class'=>'image'))?>
                    </a>
                    <div class="text-block">
                        <div class="date gray"><?=Candy::formatDate($news[0]->create_date, 'd/m')?></div>
                        <?=CHtml::link(CHtml::encode($news[0]->name),$news[0]->createUrl(),array('class'=>'caption'))?>
                    </div>
                    <hr/>
                </div>
                <?endif?>
                <?if(count($analytics)):?>
                    <div class="record news">
                        <div class="category"><?= Yii::t('main','Аналитика')?></div>
                        <a href="<?=$analytics[0]->createUrl()?>">
                            <?=$analytics[0]->media?Candy::preview(array($analytics[0]->media, 'scale' => '304x145', 'class' => 'image')):''?>
                        </a>
                        <div class="text-block">
                            <div class="date gray"><?=Candy::formatDate($analytics[0]->create_date, 'd/m')?></div>
                            <?=CHtml::link(CHtml::encode($analytics[0]->name),$analytics[0]->createUrl(),array('class'=>'caption'))?>
                        </div>
                        <hr/>
                    </div>
                <?endif?>
            </div>
            <?if($mainAnalytics):?>
                <div class="record news big">
                    <a href="<?=$mainAnalytics->createUrl()?>">
                        <?=$mainAnalytics->media?Candy::preview(array($mainAnalytics->media, 'scale' => '639x290', 'class' => 'image')):''?>
                    </a>
                    <div class="text-block">
                        <div class="category"><?= Yii::t('main','Аналитика')?></div>
                        <div class="date"><?=Candy::formatDate($mainAnalytics->create_date, 'd/m')?></div>
                        <?=CHtml::link(CHtml::encode($mainAnalytics->name),$mainAnalytics->createUrl(),array('class'=>'caption'))?>
                        <?=!empty($mainAnalytics->announce)? "<div class='notice'>" . CHtml::encode($mainAnalytics->announce) . "</div>": ''?>
                    </div>
                    <hr/>
                </div>
            <?elseif($mainNews):?>
                <div class="record news big">
                    <a href="<?=$mainNews->createUrl()?>">
                        <?=$mainNews->media?Candy::preview(array($mainNews->media, 'scale' => '639x290', 'class' => 'image')):''?>
                        <?php //echo CHtml::image('/images/assets/news-big-1.png','',array('class'=>'image'))?>
                    </a>
                    <div class="text-block">
                        <div class="category"><?= Yii::t('main','Новости')?></div>
                        <div class="date"><?=Candy::formatDate($mainNews->create_date, 'd/m')?></div>
                        <?=CHtml::link(CHtml::encode($mainNews->name),$mainNews->createUrl(),array('class'=>'caption'))?>
                        <?=!empty($mainNews->announce)? "<div class='notice'>" . CHtml::encode($mainNews->announce) . "</div>": ''?>
                    </div>
                    <hr/>
                </div>
            <?endif?>
            <div class="clear"></div>
            <div class="banner display-770 pull-right">
                <?=StaticBanner::draw(StaticBanner::MAIN_PAGE_NEWS)?>
            </div>
            <div class="left-column">
                <?
                    if(count($news)) unset($news[0]);
                    if(count($analytics)) unset($analytics[0]);
                ?>
                <?$display = true;?>
                <?foreach($news as $newsModel):?>
                <div class="record news <?=$display?'':'display-1000'?>">
                    <a href="<?=$newsModel->createUrl()?>">
                        <?=$newsModel->media?Candy::preview(array($newsModel->media, 'scale' => '304x145', 'class' => 'image under')):''?>
                    </a>
                    <div class="text-block">
                        <div class="date gray"><?=Candy::formatDate($newsModel->create_date, 'd/m')?></div>
                        <?=CHtml::link(CHtml::encode($newsModel->name),$newsModel->createUrl(),array('class'=>'caption'))?>
                        <?=!empty($newsModel->announce)? "<div class='notice'>" . CHtml::encode($newsModel->announce) . "</div>": ''?>
                    </div>
                    <hr/>
                </div>
                <?$display = false;?>
                <?endforeach?>
                <div class="record news">
                    <div class="button-panel">
                        <a class="more" href="<?=$this->createUrl('news/index')?>"><?= CHtml::button(Yii::t('main','Все новости'),array('class'=>'btn blue'))?></a>
                        <a class="more" href="#"><?= CHtml::button(Yii::t('main','Подписаться'),array('class'=>'btn'))?></a>
                    </div>
                </div>
            </div>

            <div class="right-column">
                <?if($mainNews && $mainAnalytics):?>
                <div class="record news big">
                    <a href="<?=$mainNews->createUrl()?>">
                        <?=$mainNews->media?Candy::preview(array($mainNews->media, 'scale' => '639x290', 'class' => 'image')):''?>
                        <?php //echo CHtml::image('/images/assets/news-big-1.png','',array('class'=>'image'))?>
                    </a>
                    <div class="text-block">
                        <div class="category"><?= Yii::t('main','Новости')?></div>
                        <div class="date"><?=Candy::formatDate($mainNews->create_date, 'd/m')?></div>
                        <?=CHtml::link(CHtml::encode($mainNews->name),$mainNews->createUrl(),array('class'=>'caption'))?>
                        <?=!empty($mainNews->announce)? "<div class='notice'>" . CHtml::encode($mainNews->announce) . "</div>": ''?>
                    </div>
                    <hr/>
                </div>
                <?endif?>
                <div class="chain-block bottom-news-block">
                    <?foreach($analytics as $analyticsModel):?>
                        <div class="record news">
                            <a href="<?=$analyticsModel->createUrl()?>">
                                <?=$analyticsModel->media?Candy::preview(array($analyticsModel->media, 'scale' => '304x145', 'class' => 'image under')):''?>
                            </a>
                            <div class="text-block">
                                <div class="date gray"><?=Candy::formatDate($analyticsModel->create_date, 'd/m')?></div>
                                <?=CHtml::link(CHtml::encode($analyticsModel->name),$analyticsModel->createUrl(),array('class'=>'caption'))?>
                                <?=!empty($analyticsModel->announce)? "<div class='notice'>" . CHtml::encode($analyticsModel->announce) . "</div>": ''?>
                            </div>
                            <hr/>
                        </div>
                    <?endforeach?>
                    <div class="button-panel analytics-panel">
                        <a class="more" href="<?=$this->createUrl('analytics/index')?>"><?= CHtml::button(Yii::t('main','Все статьи'),array('class'=>'btn','style'=>"width: 94px;"))?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

