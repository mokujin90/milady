<?php
    /* @var $this BaseController */

    Yii::app()->clientScript->registerCssFile('/css/frontend/reset.css');
    //Yii::app()->clientScript->registerCssFile('/css/frontend/leaflet.css');
    Yii::app()->clientScript->registerCssFile('/css/frontend/jquery.fs.scroller.css');
    Yii::app()->clientScript->registerCssFile('/css/frontend/style.region.css');
    Yii::app()->clientScript->registerCssFile('/css/frontend/stylereset.css');

    Yii::app()->clientScript->registerCssFile('/css/normalize.css');
    Yii::app()->clientScript->registerCssFile('/css/style.css');
    Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.fancybox.css');


    #JS
    Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerPackage('jquery.ui');
    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fs.scroller.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerCoreScript('ckeditor');
    Yii::app()->clientScript->registerCoreScript('sroller');
    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
    Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
Yii::app()->clientScript->registerScriptFile('/js/script.js', CClientScript::POS_END);

?>
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
    <header class="header bg-full-width grey-bg">
        <div class="content">
            <a class="logo" href="/"></a>
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

        </div><!--content-->

    </header>
        <div id="wrap">
            <div class="primary">
                <div id="base">
                    <?= $content; ?>
                </div>
            </div>
        </div>

    <?$this->renderPartial('../layouts/_popup');?>
    <?$this->renderPartial('../layouts/_footer', array('menu' => $this->getMenu()));?>
    <span class="scroll-top scroll-btn" data-href=".header"></span>
    </body>
</html>
