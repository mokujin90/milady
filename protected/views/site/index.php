<?php
/* @var $this SiteController */
    Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.bxslider.css');

    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScript('init', 'indexPart.init();', CClientScript::POS_READY);
?>
<div class="main-page">
    <?php $this->widget('YaMapWidget', array(
        'width'=>'100%',
        'height'=>291,
        'options'=>array(
            'mapId'=>'map-block',
            'mapState'=>array(
                'center'=>"Белград",
                'zoom'=>7,
                'behaviors'=>array('default', 'drag'),
            ),
        ),

    )); ?>
    <div class="dark-gray-gradient line top bottom">
        <div class="main rel">
            <div id="map-up" class="icon icon-slide-up abs"></div>
        </div>
    </div>
    <div class="promo">
        <div class="main chain-block">
            <div id="slider">
                <ul class="bxslider">
                    <li>
                        <div class="info-slide">
                            <div class="citizen">94 000 000 000</div>
                            <div class="notice">По итогам 2013 года Россия заняла первое место по объему привлеченных прямых иностранных инвестиций </div>
                        </div>
                    </li>
                    <li><?php echo CHtml::image('/images/assets/slider-1.png')?></li>
                    <li><?php echo CHtml::image('/images/assets/slider-2.png')?></li>
                </ul>
            </div>
            <div id="chart">
                <?$this->widget('application.widgets.Stock')?>
            </div>
        </div>
    </div>
    <div id="general">
        <div class="main big center">
            <a class="banner" href="#"><?php echo CHtml::image('/images/assets/banner-index-1.png')?></a>
        </div>
        <div class="content main">
            <div class="connected news-analytic">
                <div class="record news">
                    <div class="category"><?= Yii::t('main','Новости')?></div>
                    <a href="#"><?php echo CHtml::image('/images/assets/news-middle-1.png','',array('class'=>'image'))?></a>
                    <div class="text-block">
                        <div class="date gray">11/07</div>
                        <?php echo CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                    </div>
                    <hr/>
                </div>

                <div class="record news">
                    <div class="category"><?= Yii::t('main','Аналитика')?></div>
                    <a href="#"><?php echo CHtml::image('/images/assets/news-middle-2.png','',array('class'=>'image'))?></a>
                    <div class="text-block">
                        <div class="date gray">11/07</div>
                        <?php echo CHtml::link('Аналитический обзор "Об инвестиционной активности в экономике в первом квартале 2013','#',array('class'=>'caption'))?>
                    </div>
                    <hr/>
                </div>
            </div>
            <div class="connected event">
                <div class="record calendar-block">
                    <div class="category"><?= Yii::t('main','Мероприятия')?></div>
                    <div class="calendar">
                        <?php echo CHtml::image('/images/assets/calendar.png','','')?>
                    </div>
                </div>

                <div class="record news event">
                    <a href="#"><?php echo CHtml::image('/images/assets/news-slim-1.png','',array('class'=>'image'))?></a>
                    <div class="text-block">
                        <?php echo CHtml::link('Международная магаданская ярмарка инвестиционных проектов"','#',array('class'=>'caption'))?>
                        <div class="notice">Главные темы: обновленный режим Особой экономической зоны в Магаданской области, развитие</div>
                    </div>
                    <hr/>
                </div>
                <div class="button-panel">
                    <a class="more" href="#"><?= CHtml::button(Yii::t('main','Архив мероприятий'),array('class'=>'btn blue'))?></a>
                </div>
            </div>
            <div class="record news big">
                <a href="#"><?php echo CHtml::image('/images/assets/news-big-1.png','',array('class'=>'image'))?></a>
                <div class="text-block">
                    <div class="category"><?= Yii::t('main','Аналитика')?></div>
                    <div class="date">11/07</div>
                    <?= CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                </div>
                <hr/>
            </div>

            <div class="banner">
                <?php echo CHtml::image('/images/assets/banner-index-2.png','')?>
            </div>
            <div class="left-column">
                <div class="record news">
                    <a href="#"><?=CHtml::image('/images/assets/news-middle-2.png','',array('class'=>'image under'))?></a>
                    <div class="text-block">
                        <div class="date gray">11/07</div>
                        <?=CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                        <div class="notice">В рамках международной промышленной выставки "Иннопром-2014" обсуждался проект закона "О промышленной политике", который внесен в Государственную думу</div>
                    </div>
                    <hr/>
                </div>
                <div class="record news">
                    <div class="text-block">
                        <div class="date gray">11/07</div>
                        <?=CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                        <div class="notice">В рамках международной промышленной выставки "Иннопром-2014" обсуждался проект закона "О промышленной политике", который внесен в Государственную думу</div>
                    </div>
                    <hr/>
                </div>
                <div class="record news">
                    <div class="text-block">
                        <div class="date gray">11/07</div>
                        <?= CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                        <div class="notice">В рамках международной промышленной выставки "Иннопром-2014" обсуждался проект закона "О промышленной политике", который внесен в Государственную думу</div>
                    </div>
                    <hr/>
                    <div class="button-panel">
                        <a class="more" href="#"><?= CHtml::button(Yii::t('main','Все новости'),array('class'=>'btn blue'))?></a>
                        <a class="more" href="#"><?= CHtml::button(Yii::t('main','Подписаться'),array('class'=>'btn'))?></a>
                    </div>

                </div>
            </div>
            <div class="right-column">
                <div class="record news big">
                    <a href="#"><?php echo CHtml::image('/images/assets/news-big-1.png','',array('class'=>'image'))?></a>
                    <div class="text-block">
                        <div class="category"><?= Yii::t('main','Новости')?></div>
                        <div class="date">11/07</div>
                        <?= CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                    </div>
                    <hr/>
                </div>
                <div class="chain-block">
                    <div class="record news">
                        <a href="#"><?=CHtml::image('/images/assets/news-middle-2.png','',array('class'=>'image'))?></a>
                        <div class="text-block">
                            <div class="date gray">11/07</div>
                            <?=CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                        </div>
                        <hr/>
                        <div class="button-panel">
                            <a class="more" href="#"><?= CHtml::button(Yii::t('main','Все статьи'),array('class'=>'btn','style'=>"width: 94px;"))?></a>
                        </div>

                    </div>
                    <div class="record news">
                        <a href="#"><?=CHtml::image('/images/assets/news-middle-2.png','',array('class'=>'image'))?></a>
                        <div class="text-block">
                            <div class="date gray">11/07</div>
                            <?=CHtml::link('Минпромторг рассматривает "Умные" технологии как основу промышленности будущего','#',array('class'=>'caption'))?>
                        </div>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

