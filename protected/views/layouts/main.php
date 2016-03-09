<?php
/* @var $this BaseController */
/*
Yii::app()->clientScript->registerCssFile('/css/normalize.css');
Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.fancybox.css');*/
Yii::app()->clientScript->registerCssFile('/css/frontend/reset.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/leaflet.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/style.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/stylereset.css');

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.placeholder.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile('/js/leaflet.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/script.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта

/*
#JS
Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerCoreScript('ckeditor');
Yii::app()->clientScript->registerCoreScript('sroller');
Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
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
<header class="header bg-full-width grey-bg">
    <div class="content">
        <a class="logo" href="index.html"></a>
        <ul class="page-nav">
            <li>
                <a class="page-nav__link" href="#">Новости</a>

                <div class="page-nav-sec">
                    <a class="page-nav-sec__link" href="#">
                        Личный кабин7686ет
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Избран
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Мои проект uy
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Сообщение
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        576576576576 765865
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Наст75 75 765 ройки
                    </a>

                </div><!--personal-list-->

            </li>

            <li>
                <a class="page-nav__link" href="#">Инвестиции</a>

                <div class="page-nav-sec">
                    <a class="page-nav-sec__link" href="#">
                        Личный кабин7686ет
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Избран
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Мои проекты tfyutdyt dyutduyd uy
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Сообщение
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        576576576576 765865
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Наст75 75 765 ройки
                    </a>

                </div><!--personal-list-->

            <li>

            <li>
                <a class="page-nav__link" href="#">О регионе</a>

                <div class="page-nav-sec">
                    <a class="page-nav-sec__link" href="#">
                        Личный кабин7686ет
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Избран
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Мои проекты tfyutdyt dyutduyd uy
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Сообщение
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        576576576576 765865
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Наст75 75 765 ройки
                    </a>

                </div><!--personal-list-->

            <li>

            <li>
                <a class="page-nav__link" href="#">Информация</a>

                <div class="page-nav-sec">
                    <a class="page-nav-sec__link" href="#">
                        Личный кабинет
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Избран
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Мои проекты tfyutdyt dyutduyd uy
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Сообщение
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        576576576576 765865
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Наст75 75 765 ройки
                    </a>

                </div><!--personal-list-->

            <li>

            <li>
                <a class="page-nav__link" href="#">Сервис</a>

                <div class="page-nav-sec">
                    <a class="page-nav-sec__link" href="#">
                        Личный кабинет
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Избранное
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Мои проекты tfyutdyt dyutduyd uy
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Сообщение
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Профиль
                    </a>
                    <a class="page-nav-sec__link" href="#">
                        Настройки
                    </a>

                </div><!--personal-list-->

            <li>

        </ul>

        <button class="search-link">
            <i class="icon icon-link-search"></i>
        </button>

        <div class="personal">
            <span class="personal__icon-wrap">
                <i class="icon icon-personal pos-center"></i>
            </span>
            <a href="#" class="personal__user">Иванов И. И.</a>

            <div class="personal-list">
                <a class="personal-list__link" href="#">
                    Личный кабинет
                </a>
                <a class="personal-list__link" href="#">
                    Избранное
                    <span class="personal-list__count">1</span>
                </a>
                <a class="personal-list__link" href="#">
                    Мои проекты
                    <span class="personal-list__count">1</span>
                </a>
                <a class="personal-list__link" href="#">
                    Сообщение
                    <span class="personal-list__count">35</span>
                </a>
                <a class="personal-list__link" href="#">
                    Профиль
                </a>
                <a class="personal-list__link" href="#">
                    Настройки
                </a>

            </div><!--personal-list-->

        </div><!--personal-->

        <div class="region">
            <span class="region__selected">
                <i class="region-icon region-icon-1"></i>
            </span>
            <span class="region__btn">
                <i class="icon icon-arrow-down pos-center"></i>
            </span>

            <div class="region-list tabs-wrap">
                <div class="region-list-top">
                    <div class="region-list-tabs tab-links">
                        <span class="region-list-tab tab-link active" data-index="0">По алфавиту</span>
                        <span class="region-list-colon">|</span>
                        <span class="region-list-tab tab-link" data-index="1">По федеральным округам</span>
                    </div><!--region-list-tabs-->

                    <input class="region-list__field" type="text" name="region" placeholder="введите название региона"/>

                </div><!--region-list-top-->

                <div class="region-tabs tabs">
                    <div class="region-tab region-tab_alphabet tab active">
                        <ul class="region-slides">
                            <li class="region-slide spacer">
                                <div class="region-slide-col">
                                    <p class="region-slide__title">А</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Агинский Бурятский</a>
                                        <a class="region-slide-link" href="#">автономный округ</a>
                                        <a class="region-slide-link" href="#">Адыгея республика</a>
                                        <a class="region-slide-link" href="#">Алтай республика</a>
                                        <a class="region-slide-link" href="#">Алтайский край</a>
                                        <a class="region-slide-link" href="#">Амурская область</a>
                                        <a class="region-slide-link" href="#">Архангельская область</a>
                                        <a class="region-slide-link" href="#">Астраханская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Б</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Башкортостан республика</a>
                                        <a class="region-slide-link" href="#">Белгородская область</a>
                                        <a class="region-slide-link" href="#">Брянская область</a>
                                        <a class="region-slide-link" href="#">Бурятия республика</a>
                                    </nav>

                                    <p class="region-slide__title">В</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Владимирская область</a>
                                        <a class="region-slide-link" href="#">Волгоградская область</a>
                                        <a class="region-slide-link" href="#">Вологодская область</a>
                                        <a class="region-slide-link" href="#">Воронежская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Д</p>
                                    <nav class="region-slide-links region-slide-links_mb-fix">
                                        <a class="region-slide-link" href="#">Дагестан республика</a>
                                    </nav>

                                    <p class="region-slide__title">Е</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Еврейская автономная область</a>
                                    </nav>

                                    <p class="region-slide__title">И</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Ивановская область</a>
                                        <a class="region-slide-link" href="#">Ингушетия республика</a>
                                        <a class="region-slide-link" href="#">Иркутская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">К</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Кабардино-Балкария <br/> республика</a>
                                        <a class="region-slide-link" href="#">Калининградская область</a>
                                        <a class="region-slide-link" href="#">Калмыкия республика</a>
                                        <a class="region-slide-link" href="#">Калужская область</a>
                                        <a class="region-slide-link" href="#">Камчатская область</a>
                                        <a class="region-slide-link" href="#">Карачаево-Черкесская <br/> республика</a>
                                        <a class="region-slide-link" href="#">Карелия республика</a>
                                        <a class="region-slide-link" href="#">Кемеровская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                            </li>

                            <li class="region-slide spacer">
                                <div class="region-slide-col">
                                    <p class="region-slide__title">А</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Агинский Бурятский</a>
                                        <a class="region-slide-link" href="#">автономный округ</a>
                                        <a class="region-slide-link" href="#">Адыгея республика</a>
                                        <a class="region-slide-link" href="#">Алтай республика</a>
                                        <a class="region-slide-link" href="#">Алтайский край</a>
                                        <a class="region-slide-link" href="#">Амурская область</a>
                                        <a class="region-slide-link" href="#">Архангельская область</a>
                                        <a class="region-slide-link" href="#">Астраханская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Б</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Башкортостан республика</a>
                                        <a class="region-slide-link" href="#">Белгородская область</a>
                                        <a class="region-slide-link" href="#">Брянская область</a>
                                        <a class="region-slide-link" href="#">Бурятия республика</a>
                                    </nav>

                                    <p class="region-slide__title">В</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Владимирская область</a>
                                        <a class="region-slide-link" href="#">Волгоградская область</a>
                                        <a class="region-slide-link" href="#">Вологодская область</a>
                                        <a class="region-slide-link" href="#">Воронежская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Д</p>
                                    <nav class="region-slide-links region-slide-links_mb-fix">
                                        <a class="region-slide-link" href="#">Дагестан республика</a>
                                    </nav>

                                    <p class="region-slide__title">Е</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Еврейская автономная область</a>
                                    </nav>

                                    <p class="region-slide__title">И</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Ивановская область</a>
                                        <a class="region-slide-link" href="#">Ингушетия республика</a>
                                        <a class="region-slide-link" href="#">Иркутская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">К</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Кабардино-Балкария <br/> республика</a>
                                        <a class="region-slide-link" href="#">Калининградская область</a>
                                        <a class="region-slide-link" href="#">Калмыкия республика</a>
                                        <a class="region-slide-link" href="#">Калужская область</a>
                                        <a class="region-slide-link" href="#">Камчатская область</a>
                                        <a class="region-slide-link" href="#">Карачаево-Черкесская <br/> республика</a>
                                        <a class="region-slide-link" href="#">Карелия республика</a>
                                        <a class="region-slide-link" href="#">Кемеровская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                            </li>

                        </ul>

                        <div class="region-slider">
                            <span class="region-slider__prev"></span>
                            <div class="region-slider-listing">
                                <a class="region-slider-listing__item active" href="#" data-slide-index="0"></a>
                                <a class="region-slider-listing__item" href="#" data-slide-index="1"></a>
                            </div><!--region-slider-listing-->

                            <span class="region-slider__next"></span>

                        </div><!--region-slider-->

                    </div><!--region-tab-->

                    <div class="region-tab tab">
                        <ul class="region-slides">
                            <li class="region-slide spacer">
                                <div class="region-slide-col">
                                    <p class="region-slide__title">Центральный</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Белгородская область</a>
                                        <a class="region-slide-link" href="#">Брянская область</a>
                                        <a class="region-slide-link" href="#">Владимирская область</a>
                                        <a class="region-slide-link" href="#">Воронежская область</a>
                                        <a class="region-slide-link" href="#">Ивановская область</a>
                                        <a class="region-slide-link" href="#">Калужская область</a>
                                        <a class="region-slide-link" href="#">Костромская область</a>
                                        <a class="region-slide-link" href="#">Курская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Центральный</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Липецкая область</a>
                                        <a class="region-slide-link" href="#">Москва</a>
                                        <a class="region-slide-link" href="#">Московская область</a>
                                        <a class="region-slide-link" href="#">Орловская область</a>
                                        <a class="region-slide-link" href="#">Смоленская область</a>
                                        <a class="region-slide-link" href="#">Тамбовская область</a>
                                        <a class="region-slide-link" href="#">Тверская область</a>
                                        <a class="region-slide-link" href="#">Тульская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Центральный</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Ярославская область</a>
                                    </nav>

                                    <p class="region-slide__title">Приволжский</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Кировская область</a>
                                        <a class="region-slide-link" href="#">Нижегородская область</a>
                                        <a class="region-slide-link" href="#">Оренбургская область</a>
                                        <a class="region-slide-link" href="#">Пензенская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Приволжский</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Пермский край</a>
                                        <a class="region-slide-link" href="#">Республика Башкортостан</a>
                                        <a class="region-slide-link" href="#">Республика Марий Эл</a>
                                        <a class="region-slide-link" href="#">Республика Мордовия</a>
                                        <a class="region-slide-link" href="#">Республика Татарстан</a>
                                        <a class="region-slide-link" href="#">Самарская область</a>
                                        <a class="region-slide-link" href="#">Саратовская область</a>
                                        <a class="region-slide-link" href="#">Удмуртская Республика</a>
                                    </nav>

                                </div><!--region-slide-col-->

                            </li>

                            <li class="region-slide spacer">
                                <div class="region-slide-col">
                                    <p class="region-slide__title">Центральный</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Белгородская область</a>
                                        <a class="region-slide-link" href="#">Брянская область</a>
                                        <a class="region-slide-link" href="#">Владимирская область</a>
                                        <a class="region-slide-link" href="#">Воронежская область</a>
                                        <a class="region-slide-link" href="#">Ивановская область</a>
                                        <a class="region-slide-link" href="#">Калужская область</a>
                                        <a class="region-slide-link" href="#">Костромская область</a>
                                        <a class="region-slide-link" href="#">Курская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Центральный</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Липецкая область</a>
                                        <a class="region-slide-link" href="#">Москва</a>
                                        <a class="region-slide-link" href="#">Московская область</a>
                                        <a class="region-slide-link" href="#">Орловская область</a>
                                        <a class="region-slide-link" href="#">Смоленская область</a>
                                        <a class="region-slide-link" href="#">Тамбовская область</a>
                                        <a class="region-slide-link" href="#">Тверская область</a>
                                        <a class="region-slide-link" href="#">Тульская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Центральный</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Ярославская область</a>
                                    </nav>

                                    <p class="region-slide__title">Приволжский</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Кировская область</a>
                                        <a class="region-slide-link" href="#">Нижегородская область</a>
                                        <a class="region-slide-link" href="#">Оренбургская область</a>
                                        <a class="region-slide-link" href="#">Пензенская область</a>
                                    </nav>

                                </div><!--region-slide-col-->

                                <div class="region-slide-col">
                                    <p class="region-slide__title">Приволжский</p>
                                    <nav class="region-slide-links">
                                        <a class="region-slide-link" href="#">Пермский край</a>
                                        <a class="region-slide-link" href="#">Республика Башкортостан</a>
                                        <a class="region-slide-link" href="#">Республика Марий Эл</a>
                                        <a class="region-slide-link" href="#">Республика Мордовия</a>
                                        <a class="region-slide-link" href="#">Республика Татарстан</a>
                                        <a class="region-slide-link" href="#">Самарская область</a>
                                        <a class="region-slide-link" href="#">Саратовская область</a>
                                        <a class="region-slide-link" href="#">Удмуртская Республика</a>
                                    </nav>

                                </div><!--region-slide-col-->

                            </li>

                        </ul>

                        <div class="region-slider">
                            <span class="region-slider__prev"></span>
                            <div class="region-slider-listing">
                                <a class="region-slider-listing__item active" href="#" data-slide-index="0"></a>
                                <a class="region-slider-listing__item" href="#" data-slide-index="1"></a>
                            </div><!--region-slider-listing-->

                            <span class="region-slider__next"></span>

                        </div><!--region-slider-->

                    </div><!--region-tab-->

                </div><!--region-tabs-->

            </div><!--region-list-->

        </div><!--region-->

        <div class="lang">
            <span class="lang__selected">ru</span>
        </div>

    </div><!--content-->

</header>

<section class="page content">
    <div class="pager">
        <a class="pager__link" href="#">Главная</a>
        <span class="pager__active">Новости событие аналитка</span>
    </div><!--pager-->

    <?= $content; ?>

</section><!--page-->
<?$this->renderPartial('../layouts/_footer');?>
</body>
</html>