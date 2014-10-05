<?php
    /* @var $this Controller */
    Yii::app()->clientScript->registerCssFile('/css/normalize.css');
    Yii::app()->clientScript->registerCssFile('/css/style.css');

    #JS
    Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
    Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="language" content="ru" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="wrap">
            <div class="primary">
                <header>
                    <div id="bar-block">
                        <div class="main chain-block">
                            <div class="item avatar point">
                                <?php echo CHtml::image('/images/assets/avatar.png','')?>
                                <span>multeg</span>
                                <i class="icon icon-arrow"></i>
                            </div>
                            <div id="my-project" class="item project point">
                                <i class="icon icon-my-project"></i>
                                <span><?php echo Yii::t('main','Мои проекты')?></span>
                                <i class="icon icon-arrow"></i>
                                <div class="box dark slide">
                                    <div class="box inner">
                                        <div class="data">
                                            <span class="count">4</span>
                                            <span class="header"><?php echo Yii::t('main','Выбор проекта')?></span>
                                        </div>
                                        <hr/>
                                        <div class="project-list">
                                            <a data-project="0" data-status="3" href="#" class="item active">
                                                <?php echo CHtml::image('/images/assets/project-logo.png','',array('class'=>'project-logo'))?>
                                                <span class="text"><?php echo Yii::t('main','Название проекта в работе')?></span>
                                            </a>
                                            <a data-project="1" data-status="0" href="#" class="item">
                                                <span class="text">Название предполагаемого проекта 1</span>
                                            </a>
                                            <a data-project="2" data-status="2" href="#" class="item">
                                                <span class="text">Название предполагаемого проекта 2</span>
                                            </a>
                                            <a data-project="3 "data-status="5" href="#" class="item">
                                                <span class="text">Название предполагаемого проекта 3</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="status-block chain-block">
                                        <span class="text"><?php echo Yii::t('main','Степень выполнености')?></span>
                                        <div class="status-widget">
                                            <div class="rank"></div>
                                            <div class="rank"></div>
                                            <div class="rank"></div>
                                            <div class="rank"></div>
                                            <div class="rank"></div>
                                            <div class="rank"></div>
                                            <div class="rank"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item favorites point">
                                <i class="icon icon-favorites"></i>
                                <span><?php echo Yii::t('main','Избранное')?></span>
                                <i class="icon icon-arrow"></i>
                            </div>
                            <div class="item message point">
                                <i class="icon icon-balloon"><span>15</span></i>
                                <span><?php echo Yii::t('main','Сообщения')?></span>
                                <i class="icon icon-arrow"></i>
                            </div>
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'htmlOptions'=>array('class'=>'search-form'))); ?>
                            <div class="search chain-block">
                                <?php echo CHtml::textField('Search[text]','')?>
                                <div class="button"><?php echo CHtml::submitButton('',array('class'=>'image icon icon-search-gray'))?></div>
                            </div>
                            <?php $this->endWidget(); ?>
                            <div id="language-list">
                                <?php echo CHtml::link('RU<i class="icon icon-stick-down"></i>','#',array('class'=>'item active'))?>
                                <?php echo CHtml::link('EN','#',array('class'=>'item hide'))?>
                            </div>
                        </div>
                    </div>
                    <div id="logo-block">
                        <div class="main chain-block">
                            <?php echo CHtml::image('/images/markup/logo.png','',array('class'=>'logo'))?>
                            <div class="subscribe-block">
                                <div class="header"><?php echo Yii::t('main','Подпишитесь!')?></div>
                                <div class="text"><?php echo Yii::t('main','Вы сможите получать самые актуальные данные инвест проектов')?></div>
                                <div class="subscribe-panel chain-block">
                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                        'htmlOptions'=>array('class'=>'subscribe-form form'))); ?>
                                    <?php echo CHtml::textField('Subscribe[email]','',array('placeholder'=>Yii::t('main','введите e-mail')))?>
                                    <?php echo CHtml::submitButton(Yii::t('main','Подписаться'),array('class'=>'btn'))?>
                                    <?php $this->endWidget(); ?>
                                    <ul class="social">
                                        <li><?php echo CHtml::link('','#',array('class'=>'icon icon-facebook'))?></li>
                                        <li><?php echo CHtml::link('','#',array('class'=>'icon icon-twitter'))?></li>
                                        <li><?php echo CHtml::link('','#',array('class'=>'icon icon-tumblr'))?></li>
                                        <li><?php echo CHtml::link('','#',array('class'=>'icon icon-odnoklassniki'))?></li>
                                        <li><?php echo CHtml::link('','#',array('class'=>'icon icon-vk'))?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="light-gray-gradient" id="nav-block">
                        <div class="main chain-block">
                            <div class="menu chain-block">
                                <div class="item"><?php echo Yii::t('main','Контакты')?></div><i class="icon icon-separator-blue"></i>
                                <div class="item"><?php echo Yii::t('main','Обратная связь')?></div><i class="icon icon-separator-blue"></i>
                                <div class="item"><?php echo Yii::t('main','О проекте')?></div><i class="icon icon-separator-blue"></i>
                                <div class="item"><?php echo Yii::t('main','Команда')?></div>
                            </div>
                            <div class="place chain-block">
                                <div class="region">
                                    <span class="name"><?php echo Yii::t('main','Центральный округ')?></span>
                                    <div class="slide-down-button icon icon-button-down"></div>
                                </div>
                                <div class="city"><?php echo Yii::t('main','Москва')?></div>
                            </div>
                        </div>
                    </div>
                    <div class="dark-gray-gradient line bottom" id="menu-block">
                        <div class="main">
                            <div class="item">
                                <div class="picture"><div class="icon icon-investition"></div></div>
                                <div class="name"><?php echo Yii::t('main','Инвесторы')?></div>
                            </div>
                            <div class="item">
                                <div class="picture"><div class="icon icon-project"></div></div>
                                <div class="name"><?php echo Yii::t('main','Проекты')?></div>
                            </div>
                            <div class="item">
                                <div class="picture"><div class="icon icon-region"></div></div>
                                <div class="name"><?php echo Yii::t('main','Регионы')?></div>
                            </div>
                            <div class="item">
                                <div class="picture"><div class="icon icon-law"></div></div>
                                <div class="name"><?php echo Yii::t('main','Законодательство')?></div>
                            </div>
                            <div class="item">
                                <div class="picture"><div class="icon icon-analitik"></div></div>
                                <div class="name"><?php echo Yii::t('main','Аналитика и новости')?></div>
                            </div>
                            <div class="item">
                                <div class="picture"><div class="icon icon-library"></div></div>
                                <div class="name"><?php echo Yii::t('main','Библиотека')?></div>
                            </div>
                        </div>
                    </div>
                </header>
                <div id="base">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        <footer>
            <div class="dark-gray-gradient line top"></div>
            <div class="data">
                <div class="main chain-block">
                    <div class="col category">
                        <div class="header"><?php echo Yii::t('main','Направления')?> <span class="separator"></span></div>
                        <div class="list">
                            <a href="#"><div class="picture"><i class="icon icon-investition-min"></i></div><span class="text"><?php echo Yii::t('main','Инвесторы')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-project-min"></i></div><span class="text"><?php echo Yii::t('main','Проекты')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-region-min"></i></div><span class="text"><?php echo Yii::t('main','Регионы')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-law-min"></i></div><span class="text"><?php echo Yii::t('main','Законодательство')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-analitik-min"></i></div><span class="text"><?php echo Yii::t('main','Аналитика и новости')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-library-min"></i></div><span class="text"><?php echo Yii::t('main','Библиотека')?></span></a>
                        </div>
                    </div>
                    <div class="col sitemap">
                        <div class="header"><span class="empty"></span> <span class="separator"></span></div>
                        <div class="list">
                            <?php echo CHtml::link(Yii::t('main','Контакты'),'#')?>
                            <?php echo CHtml::link(Yii::t('main','Обратная связь'),'#')?>
                            <?php echo CHtml::link(Yii::t('main','О проекте'),'#')?>
                            <?php echo CHtml::link(Yii::t('main','Команда'),'#')?>
                        </div>
                        <hr/>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'htmlOptions'=>array('class'=>'search-form'))); ?>
                        <div class="search chain-block">
                            <?php echo CHtml::textField('Search[text]','',array('placeholder'=>Yii::t('main','поиск')))?>
                            <div class="button"><?php echo CHtml::submitButton('',array('class'=>'image icon icon-search-gray'))?></div>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                    <div class="contact col">
                        <div class="header"><?php echo Yii::t('main','Адрес')?> <span class="separator"></span></div>
                        <div class="text address">125468, г. Москва, Ленинградский пр., 49</div>
                        <div class="header"><?php echo Yii::t('main','Тел./Факс')?></div>
                        <div class="text phone">+7 (495) 744-34-72</div>
                        <div class="header"><?php echo Yii::t('main','E-mail')?></div>
                        <div class="text email"><?php echo CHtml::mailto('info@iip.ru','info@iip.ru')?></div>
                    </div>
                    <div class="subscribe col">
                        <div class="header"><?php echo Yii::t('main','Подписаться на рассылку')?> <span class="separator"></span></div>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'htmlOptions'=>array('class'=>'subscribe-form form'))); ?>
                        <?php echo CHtml::textField('Subscribe[email]','',array('placeholder'=>Yii::t('main','введите e-mail')))?>
                        <?php echo CHtml::submitButton(Yii::t('main','Подписаться'),array('class'=>'btn'))?>
                        <?php $this->endWidget(); ?>
                        <ul class="social">
                            <li><?php echo CHtml::link('','#',array('class'=>'icon icon-vk-gray'))?></li>
                            <li><?php echo CHtml::link('','#',array('class'=>'icon icon-facebook-gray'))?></li>
                            <li><?php echo CHtml::link('','#',array('class'=>'icon icon-twitter-gray'))?></li>
                            <li><?php echo CHtml::link('','#',array('class'=>'icon icon-youtube-gray'))?></li>
                            <li><?php echo CHtml::link('','#',array('class'=>'icon icon-rss-gray'))?></li>
                            <div class="counter">
                                <a href="#" target="_blank">
                                    <img src="/images/assets/liveinternet.png" border="0" width="88" height="31" title="liveinternet.ru: показано количество просмотров и посетителей за 24 часа">
                                </a>
                            </div>
                        </ul>
                        <div class="abs copyright">Copyright © 2014</div>
                    </div>
                </div>
            </div>
            <div id="scroll-up" class="point"></div>
        </footer>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            /*(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
                function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
                e=o.createElement(i);r=o.getElementsByTagName(i)[0];
                e.src='//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');*/
        </script>
    </body>
</html>
