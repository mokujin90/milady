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
    <div class="dark-gray-gradient line top bottom"></div>
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
            </div>
        </div>
    </div>
    <div id="general">
        <div class="main big center">
            <a class="banner" href="#"><?php echo CHtml::image('/images/assets/banner-index-1.png')?></a>
        </div>
        <div class="content main">
            <div class="col-sm-1">
                <div class="category">Новости</div>
            </div>
            <div class="col-sm-1">
                <div class="category">Аналитика</div>
            </div>
            <div class="col-sm-1">
                <div class="category">Мероприятия</div>
            </div>
            <div class="col-sm-1 news">
                <a href="#"><?php echo CHtml::image('/images/assets/news-middle-1.png')?></a>
                <div class="text-block">
                    <div class="date gray">11/07</div>
                    <?php echo CHtml::link('Минпромторг рассматривает "Умные" технологиикак основу промышленности будущего','',array('class'=>'caption'))?>
                    <hr/>
                </div>
            </div>
            <div class="col-sm-1 news">
                <a href="#"><?php echo CHtml::image('/images/assets/news-middle-1.png')?></a>
                <div class="text-block">
                    <div class="date gray">11/07</div>
                    <?php echo CHtml::link('Минпромторг рассматривает "Умные" технологиикак основу промышленности будущего','',array('class'=>'caption'))?>
                    <hr/>
                </div>
            </div>
            <div class="col-sm-1 calendar">

            </div>
            <div class="col-sm-2 news">
                <a href="#"><?php echo CHtml::image('/images/assets/news-big-1.png')?></a>
            </div>
            <div class="col-sm-1 news">
                <a href="#"><?php echo CHtml::image('/images/assets/news-middle-1.png')?></a>
                <div class="text-block">
                    <div class="date gray">11/07</div>
                    <?php echo CHtml::link('Минпромторг рассматривает "Умные" технологиикак основу промышленности будущего','',array('class'=>'caption'))?>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
</div>

