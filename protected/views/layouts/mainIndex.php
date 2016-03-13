<?php
/* @var $this BaseController */
/*
Yii::app()->clientScript->registerCssFile('/css/normalize.css');
Yii::app()->clientScript->registerCssFile('/css/style.css');*/
Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.fancybox.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/reset.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/leaflet.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/style.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/stylereset.css');

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.placeholder.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile('/js/leaflet.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
Yii::app()->clientScript->registerScriptFile('/js/script.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/confirmDialog.js', CClientScript::POS_END);
/*
#JS
Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('ckeditor');
Yii::app()->clientScript->registerCoreScript('sroller');
Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/confirmDialog.js', CClientScript::POS_END);*/?>
<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Международные инвестиционные проекты</title>
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
    <![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>
<?=CHtml::hiddenField('currentController',Yii::app()->controller->getId(),array('id'=>'current-controller'))?>
<?=CHtml::hiddenField('currentAction',Yii::app()->controller->getAction()->getId(),array('id'=>'current-action'))?>
<section class="main-slider bg-full-width">
    <header class="header bg-full-width header_main">
        <div class="content">
            <a class="logo" href="#"></a>
            <?$this->renderPartial('../layouts/_headerMenu', array('menu' => $this->getMenu()));?>
            <?$this->renderPartial('../layouts/_searchMenu');?>
            <?$this->renderPartial('../layouts/_userMenu');?>

            <div class="region">
                <span class="region__selected">
                    <?=$this->region->content->logo ? Candy::preview(array($this->region->content->logo,'scale'=>'30x36', 'scaleMode' => 'in', 'class' => 'region-icon')) : ''?>
                    <!--i class="region-icon region-icon-1"></i-->
                </span>
                <span class="region__btn">
                    <i class="icon icon-arrow-down pos-center"></i>
                </span>
                <?$this->widget('application.widgets.regionList.RegionListWidget',array());?>
            </div><!--region-->

            <div class="lang">
                <span class="lang__selected">ru</span>
            </div>

            <div class="subscribe">
                <a class="subscribe__link subscribe__link_fb" href="#"></a>
                <a class="subscribe__link subscribe__link_tw" href="#"></a>
                <a class="subscribe__link subscribe__link_vk" href="#"></a>
            </div><!--subscribe-->

        </div><!--content-->

    </header>

    <div class="main-slider-wrap">
        <ul class="main-slides">
            <?$count = 0?>
            <?if (!Yii::app()->user->isGuest && $this->user->profileCompletion() < 100) {?>
            <?$count++?>
            <li class="main-slide">
                <i class="main-slide__bg main-slide__bg_1"></i>
                <div class="content">
                    <h1 class="main-slide__title">
                        <?=Yii::t('main', 'Международные <br/> инвестиционные проекты')?>
                    </h1>
                    <p class="main-slide__desc">
                    <span>
                        <i class="icon icon-search-doc"></i>
                        <?=Yii::t('main', 'Заполните профиль, что бы получать актуальные предложения')?>
                    </span>
                    </p>

                    <a class="blue-btn main-slide__btn" href="<?=$this->createUrl('user/profile')?>"><?=Yii::t('main', 'Редактировать профиль')?></a>

                </div><!--content-->

            </li>
            <?}?>
            <?$count++?>
            <li class="main-slide">
                <i class="main-slide__bg main-slide__bg_1"></i>
                <div class="content">
                    <h1 class="main-slide__title">
                        <?=Yii::t('main', 'Международные <br/> инвестиционные проекты')?>
                    </h1>
                    <p class="main-slide__desc">
                    <span>
                        <i class="icon icon-text"></i>
                        <?=Yii::t('main', 'Инвестиционные проекты на карте')?>
                        <i class="icon icon-mark"></i>
                    </span>
                    </p>

                    <a class="blue-btn main-slide__btn" href="<?=$this->createUrl('project/map')?>"><?=Yii::t('main', 'Смотреть на карте')?></a>

                </div><!--content-->

            </li>

            <?if (Yii::app()->user->isGuest) {?>
            <?$count++?>
            <li class="main-slide">
                <i class="main-slide__bg main-slide__bg_1"></i>
                <div class="content">
                    <h1 class="main-slide__title">
                        <?=Yii::t('main', 'Международные <br/> инвестиционные проекты')?>
                    </h1>
                    <?php if(Yii::app()->user->isGuest):?>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'htmlOptions'=>array('class'=>'subscribe-form form'))); ?>

                        <?= CHtml::emailField('Subscribe[email]','',array('class' => 'main-slide__field', 'placeholder'=>Yii::t('main','введите e-mail')))?>
                        <?= CHtml::submitButton(Yii::t('main', 'Подпишитесь на полезную информацию'),array('class'=>'blue-btn main-slide__btn main-slide__btn_big guest-subscribe'))?>
                        <?php $this->endWidget(); ?>
                    <?php endif;?>

                    <p class="main-slide__desc main-slide__desc_fix">
                        <span><?=Yii::t('main', 'Вы сможете получать самые актуальные данные инвест проектов')?></span>
                    </p>

                </div><!--content-->

            </li>
            <?}?>

            <?foreach (IndexSlider::model()->findAll() as $indexSlideItem) { ?>
                <?$count++?>
                <li class="main-slide">
                    <i class="main-slide__bg main-slide__bg_1"></i>
                    <div class="content">
                        <h1 class="main-slide__title">
                            <?=Yii::t('main', 'Международные <br/> инвестиционные проекты')?>
                        </h1>
                        <p class="main-slide__desc">
                        <span>
                            <?=$indexSlideItem->text?>
                        </span>
                        </p>

                        <a class="blue-btn main-slide__btn" href="<?=$indexSlideItem->url?>"><?=$indexSlideItem->name?></a>

                    </div><!--content-->
                </li>
            <?}?>
        </ul>

        <div class="main-slider-pager">
            <?for($i = 0; $i < $count; $i++){?>
                <a class="main-slider-pager__link <?=$i == 0 ? 'active' : ''?>" href="#" data-slide-index="<?=$i?>"></a>
            <?}?>
        </div><!--main-slider-pager-->

    </div><!--main-slider-wrap-->

</section>
<?= $content; ?>
<?$this->renderPartial('../layouts/_popup');?>
<?$this->renderPartial('../layouts/_footer', array('menu' => $this->getMenu()));?>

<span class="scroll-top scroll-btn" data-href=".header"></span>



<script>
   /* var map = L.map('project-map').setView([51.505, -0.09], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
        maxZoom: 18,
        attribution: false,
        id: 'mapbox.streets'
    }).addTo(map);*/

</script>

</body>
</html>