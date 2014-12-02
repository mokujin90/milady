<?php
    /* @var $this Controller */
    Yii::app()->clientScript->registerCssFile('/css/normalize.css');
    Yii::app()->clientScript->registerCssFile('/css/style.css');
    Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.fancybox.css');


    #JS
    Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
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
        <title><?= CHtml::encode($this->pageTitle); ?></title>
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
                            <?if(Yii::app()->user->isGuest):?>
                                <div class="item login point">
                                    <span>
                                        <?=CHtml::link(Yii::t('main','Войти'),'#auth-content',array('class'=>'auth-fancy'))?>
                                    </span>
                                </div>
                            <?else:?>
                                <div class="menu-slide item avatar point">
                                    <?=Candy::preview(array($this->user->logo, 'scale' => '26x26'))?>
                                    <span><?=$this->user->login?></span>
                                    <i class="icon icon-arrow"></i>
                                    <div class="dark slide">
                                        <?php echo CHtml::link(Yii::t('main','Профиль'),array('user/profile'),array())?>
                                        <?php echo CHtml::link(Yii::t('main','Проекты'),array('user/projectList'),array())?>
                                        <?php echo CHtml::link(Yii::t('main','Выйти'),array('user/logout'),array())?>
                                    </div>
                                </div>
                            <?endif;?>
                                <div id="my-project" class="menu-slide item project point">
                                    <?if(!Yii::app()->user->isGuest):?>
                                        <i class="icon icon-my-project"></i>
                                        <span><?= Yii::t('main','Мои проекты')?></span>
                                        <i class="icon icon-arrow"></i>
                                        <div class="box dark slide">
                                            <?$myProject = Project::findMyProject(Yii::app()->user->id);?>
                                            <div class="box inner">
                                                <div class="data">
                                                    <span class="count"><?=count($myProject)?></span>
                                                    <span class="header"><?= Yii::t('main','Выбор проекта')?></span>
                                                </div>
                                                <hr/>
                                                <div class="project-list">
                                                    <?foreach($myProject as $project):?>
                                                        <a data-project="<?=$project->id?>" data-status="<?=$project->getCompleteRank()?>" href="<?=$this->createUrl('project/detail',array('id'=>$project->id))?>" class="item <?if($project->complete==100):?>active<?endif;?>">
                                                            <?=Candy::preview(array($project->logo,'scale'=>'55x55','class'=>'project-logo'))?>

                                                            <span class="text"><?= CHtml::encode($project->name)?></span>
                                                        </a>
                                                    <?endforeach;?>
                                                </div>
                                            </div>
                                            <div class="status-block chain-block">
                                                <span class="text"><?= Yii::t('main','Степень выполнености')?></span>
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
                                    <?endif;?>
                                </div>
                                <a class="item favorites point" href="<?=$this->createUrl('user/favoriteList')?>">
                                    <?if(!Yii::app()->user->isGuest):?>
                                        <i class="icon icon-favorites"></i>
                                        <span><?= Yii::t('main','Избранное')?></span>
                                        <i class="icon icon-arrow"></i>
                                    <?endif;?>
                                </a>
                                <a class="item message point" href="<?=$this->createUrl('message/inbox')?>">
                                    <?if(!Yii::app()->user->isGuest):?>
                                        <i class="icon icon-balloon"><span><?=Message::getUnreadCount('all')?></span></i>
                                        <span><?= Yii::t('main','Сообщения')?></span>
                                        <i class="icon icon-arrow"></i>
                                    <?endif;?>
                                </a>
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'htmlOptions'=>array('class'=>'search-form'))); ?>
                                <div class="search chain-block">
                                    <?= CHtml::textField('Search[text]','')?>
                                    <div class="button"><?= CHtml::submitButton('',array('class'=>'image icon icon-search-gray'))?></div>
                                </div>
                                <?php $this->endWidget(); ?>
                                <div id="language-list">
                                    <?= CHtml::link('RU<i class="icon icon-stick-down"></i>','#',array('class'=>'item active'))?>
                                    <?= CHtml::link('EN','#',array('class'=>'item hide'))?>
                                </div>
                        </div>
                    </div>
                    <div id="logo-block">
                        <div class="main chain-block">
                            <a href="/"><?= CHtml::image('/images/markup/logo.png','',array('class'=>'logo'))?></a>
                            <div class="subscribe-block">
                                <div class="header"><?= Yii::t('main','Подпишитесь!')?></div>
                                <div class="text"><?= Yii::t('main','Вы сможите получать самые актуальные данные инвест проектов')?></div>
                                <div class="subscribe-panel chain-block">
                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                        'htmlOptions'=>array('class'=>'subscribe-form form'))); ?>
                                    <?= CHtml::textField('Subscribe[email]','',array('placeholder'=>Yii::t('main','введите e-mail')))?>
                                    <?= CHtml::submitButton(Yii::t('main','Подписаться'),array('class'=>'btn'))?>
                                    <?php $this->endWidget(); ?>
                                    <ul class="social">
                                        <li><?= CHtml::link('','#',array('class'=>'icon icon-facebook'))?></li>
                                        <li><?= CHtml::link('','#',array('class'=>'icon icon-twitter'))?></li>
                                        <li><?= CHtml::link('','#',array('class'=>'icon icon-tumblr'))?></li>
                                        <li><?= CHtml::link('','#',array('class'=>'icon icon-odnoklassniki'))?></li>
                                        <li><?= CHtml::link('','#',array('class'=>'icon icon-vk'))?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="light-gray-gradient" id="nav-block">
                        <div class="main chain-block">
                            <div class="menu chain-block">
                                <div class="item"><?= Yii::t('main','Контакты')?></div><i class="icon icon-separator-blue"></i>
                                <div class="item"><?= Yii::t('main','Обратная связь')?></div><i class="icon icon-separator-blue"></i>
                                <div class="item"><?= Yii::t('main','О проекте')?></div><i class="icon icon-separator-blue"></i>
                                <div class="item"><?= Yii::t('main','Команда')?></div>
                            </div>
                            <div class="place chain-block">
                                <!--<div class="region">
                                    <span class="name"><? //=Yii::t('main','Центральный округ')?></span>
                                    <div class="slide-down-button icon icon-button-down"></div>
                                </div>
                                <div class="city"><?//= Yii::t('main','Москва')?></div>-->
                                <?$this->widget('crud.dropDownList',array(
                                    'elements'=>Region::getDrop(),
                                    'selected'=>$this->getCurrentRegion(),
                                    'htmlOptions'=>array(
                                        'id'=>'city-drop'
                                    ),
                                    'options'=>array(
                                        'multiple'=>false,
                                        'skin'=>'city'
                                    )
                                ));?>
                            </div>
                        </div>
                    </div>
                    <div class="dark-gray-gradient line bottom <?if($this->interface['slim_menu']):?>slim<?endif;?>" id="menu-block">
                        <div class="main">
                            <a class="item i1" href="<?=$this->createUrl('investor/index')?>">
                                <?= CHtml::image('/images/sprites/investition.png','',array('class'=>'picture'))?>
                                <div class="name"><?=Yii::t('main','Инвесторы')?></div>
                            </a>
                            <a class="item i2" href="<?=$this->createUrl('project/index')?>">
                                <?= CHtml::image('/images/sprites/project.png','',array('class'=>'picture'))?>
                                <div class="name"><?=Yii::t('main','Проекты')?></div>
                            </a>
                            <a class="item i3" href="<?=$this->createUrl('region/index')?>">
                                <?= CHtml::image('/images/sprites/region.png','',array('class'=>'picture'))?>
                                <div class="name"><?=Yii::t('main','Регионы')?></div>
                            </a>
                            <a class="item i4" href="#">
                                <?= CHtml::image('/images/sprites/law.png','',array('class'=>'picture'))?>
                                <div class="name"><?=Yii::t('main','Законодательство')?></div>
                            </a>
                            <a class="item i5" href="<?=$this->createUrl('site/AnalyticsAndNews')?>">
                                <?= CHtml::image('/images/sprites/analitik.png','',array('class'=>'picture'))?>
                                <div class="name"><?=Yii::t('main','Аналитика и новости')?></div>
                            </a>
                            <a class="item i6" href="#">
                                <?= CHtml::image('/images/sprites/library.png','',array('class'=>'picture'))?>
                                <div class="name"><?=Yii::t('main','Библиотека')?></div>
                            </a>
                        </div>
                    </div>
                </header>
                <div id="base">
                    <?= $content; ?>
                </div>
            </div>
        </div>
        <footer>
            <div class="dark-gray-gradient line top"></div>
            <div class="data">
                <div class="main chain-block">
                    <div class="col category">
                        <div class="header"><?= Yii::t('main','Направления')?> <span class="separator"></span></div>
                        <div class="list">
                            <a href="#"><div class="picture"><i class="icon icon-investition-min"></i></div><span class="text"><?= Yii::t('main','Инвесторы')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-project-min"></i></div><span class="text"><?= Yii::t('main','Проекты')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-region-min"></i></div><span class="text"><?= Yii::t('main','Регионы')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-law-min"></i></div><span class="text"><?= Yii::t('main','Законодательство')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-analitik-min"></i></div><span class="text"><?= Yii::t('main','Аналитика и новости')?></span></a>
                            <a href="#"><div class="picture"><i class="icon icon-library-min"></i></div><span class="text"><?= Yii::t('main','Библиотека')?></span></a>
                        </div>
                    </div>
                    <div class="col sitemap">
                        <div class="header"><span class="empty"></span> <span class="separator"></span></div>
                        <div class="list">
                            <?= CHtml::link(Yii::t('main','Контакты'),'#')?>
                            <?= CHtml::link(Yii::t('main','Обратная связь'),'#')?>
                            <?= CHtml::link(Yii::t('main','О проекте'),'#')?>
                            <?= CHtml::link(Yii::t('main','Команда'),'#')?>
                        </div>
                        <hr/>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'htmlOptions'=>array('class'=>'search-form'))); ?>
                        <div class="search chain-block">
                            <?= CHtml::textField('Search[text]','',array('placeholder'=>Yii::t('main','поиск')))?>
                            <div class="button"><?= CHtml::submitButton('',array('class'=>'image icon icon-search-gray'))?></div>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                    <div class="contact col">
                        <div class="header"><?= Yii::t('main','Адрес')?> <span class="separator"></span></div>
                        <div class="text address">125468, г. Москва, Ленинградский пр., 49</div>
                        <div class="header"><?= Yii::t('main','Тел./Факс')?></div>
                        <div class="text phone">+7 (495) 744-34-72</div>
                        <div class="header"><?= Yii::t('main','E-mail')?></div>
                        <div class="text email"><?= CHtml::mailto('info@iip.ru','info@iip.ru')?></div>
                    </div>
                    <div class="subscribe col">
                        <div class="header"><?= Yii::t('main','Подписаться на рассылку')?> <span class="separator"></span></div>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'htmlOptions'=>array('class'=>'subscribe-form form'))); ?>
                        <?= CHtml::textField('Subscribe[email]','',array('placeholder'=>Yii::t('main','введите e-mail')))?>
                        <?= CHtml::submitButton(Yii::t('main','Подписаться'),array('class'=>'btn'))?>
                        <?php $this->endWidget(); ?>
                        <ul class="social">
                            <li><?= CHtml::link('','#',array('class'=>'icon icon-vk-gray'))?></li>
                            <li><?= CHtml::link('','#',array('class'=>'icon icon-facebook-gray'))?></li>
                            <li><?= CHtml::link('','#',array('class'=>'icon icon-twitter-gray'))?></li>
                            <li><?= CHtml::link('','#',array('class'=>'icon icon-youtube-gray'))?></li>
                            <li><?= CHtml::link('','#',array('class'=>'icon icon-rss-gray'))?></li>
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
        <div class="hidden" id="auth-content">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>'/user/login',
                'htmlOptions'=>array(
                    'class'=>'auth-form'
                )
            )); ?>
            <div class="row text-center">
                Авторизация
            </div>
            <div class="row">
                <?php echo CHtml::textField('LoginForm[username]','',array('placeholder'=>Yii::t('main','Логин')))?>
                <div class="errorMessage" id="LoginForm_username_em_" style="display: none;"></div>
            </div>
            <div class="row">
                <?php echo CHtml::passwordField('LoginForm[password]','',array('placeholder'=>Yii::t('main','Пароль')))?>
                <div class="errorMessage" id="LoginForm_password_em_" style="display: none;"></div>
            </div>
            <div class="data">
                <?php echo CHtml::checkBox('LoginForm[rememberMe]',true,array('id'=>'login_forget_me'))?>
                <?php echo CHtml::label(Yii::t('main','Запомнить меня'),'login_forget_me')?>
                <?php echo CHtml::link(Yii::t('main','Забыли пароль?'),'#',array('class'=>'is-forget'))?>
            </div>
            <div class="data">
                <?php echo
                CHtml::ajaxSubmitButton('Войти',CHtml::normalizeUrl(array('user/login')),
                    array(
                        'dataType'=>'json',
                        'type'=>'post',
                        'success'=>'function(data)
                        {
                          form.ajaxError(data,".auth-form")
                        }'
                    ),array('class' => 'btn','id' => 'login-action'));
                ?>
                <?php // echo CHtml::link(Yii::t('main','Зарегистрироваться'),array('user/registerForm'),array('class'=>'fancybox.ajax dash register'))?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
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
