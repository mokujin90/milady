<?php
/* @var $this BaseController */
Yii::app()->clientScript->registerCssFile('/css/theme/bootstrap.min.css');
Yii::app()->clientScript->registerCssFile('/css/theme/font-awesome.min.css');
Yii::app()->clientScript->registerCssFile('/css/theme/pace.css');
Yii::app()->clientScript->registerCssFile('/css/theme/app.css');
Yii::app()->clientScript->registerCssFile('/css/theme/app-skin.css');
Yii::app()->clientScript->registerCssFile('/css/theme/jcarousel.responsive.css');

#JS
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile('/js/theme/bootstrap.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/modernizr.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/pace.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.popupoverlay.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.slimscroll.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.cookie.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.jcarousel.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/app.js', CClientScript::POS_END);

Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerCoreScript('ckeditor');
Yii::app()->clientScript->registerCoreScript('sroller');
Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Perfect Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
</head>

<body class="overflow-hidden">
<!-- Overlay Div -->
<div id="overlay" class="transparent"></div>

<a href="" id="theme-setting-icon" style="display: none;"><i class="fa fa-cog fa-lg"></i></a>
<div id="theme-setting">
    <div class="title">
        <strong class="no-margin">Skin Color</strong>
    </div>
    <div class="theme-box">
        <a class="theme-color" style="background:#323447" id="default"></a>
        <a class="theme-color" style="background:#efefef" id="skin-1"></a>
        <a class="theme-color" style="background:#a93922" id="skin-2"></a>
        <a class="theme-color" style="background:#3e6b96" id="skin-3"></a>
        <a class="theme-color" style="background:#635247" id="skin-4"></a>
        <a class="theme-color" style="background:#3a3a3a" id="skin-5"></a>
        <a class="theme-color" style="background:#495B6C" id="skin-6"></a>
    </div>
    <div class="title">
        <strong class="no-margin">Sidebar Menu</strong>
    </div>
    <div class="theme-box">
        <label class="label-checkbox">
            <input type="checkbox" checked id="fixedSidebar">
            <span class="custom-checkbox"></span>
            Fixed Sidebar
        </label>
    </div>
</div><!-- /theme-setting -->

<div id="wrapper" class="preload">
    <div id="top-nav" class="skin-6 fixed">
        <div class="brand">
            <span>IIP</span>
        </div><!-- /brand -->

        <button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <ul class="nav-notification clearfix pull-left">
            <li>
                <a href="<?=$this->createUrl('investor/index')?>" title="<?=Yii::t('main','Инвесторы')?>">
                    <i class="fa fa-user fa-lg"></i>
                    <strong class="hidden-md hidden-sm hidden-xs">&nbsp;<?=Yii::t('main','Инвесторы')?></strong>
                </a>
            </li>
            <li>
                <a href="<?=$this->createUrl('project/index')?>" title="<?=Yii::t('main','Проекты')?>">
                    <i class="fa fa-file fa-lg"></i>
                    <strong class="hidden-md hidden-sm hidden-xs">&nbsp;<?=Yii::t('main','Проекты')?></strong>
                </a>
            </li>
            <li>
                <a href="<?=$this->createUrl('region/social')?>" title="<?=Yii::t('main','О регионе')?>">
                    <i class="fa fa-map fa-lg"></i>
                    <strong class="hidden-md hidden-sm hidden-xs">&nbsp;<?=Yii::t('main','О регионе')?></strong>
                </a>
            </li>
            <li>
                <a href="<?=$this->createUrl('law/index')?>" title="<?=Yii::t('main','Законодательство')?>">
                    <i class="fa fa-balance-scale fa-lg"></i>
                    <strong class="hidden-md hidden-sm hidden-xs">&nbsp;<?=Yii::t('main','Законодательство')?></strong>
                </a>
            </li>
            <li>
                <a href="<?=$this->createUrl('site/AnalyticsAndNews')?>" title="<?=Yii::t('main','Новости')?>">
                    <i class="fa fa-area-chart fa-lg"></i>
                    <strong class="hidden-md hidden-sm hidden-xs">&nbsp;<?=Yii::t('main','Новости')?></strong>
                </a>
            </li>
            <li>
                <a href="<?=$this->createUrl('library/index')?>" title="<?=Yii::t('main','Библиотека')?>">
                    <i class="fa fa-book fa-lg"></i>
                    <strong class="hidden-md hidden-sm hidden-xs">&nbsp;<?=Yii::t('main','Библиотека')?></strong>
                </a>
            </li>
        </ul>

        <ul class="nav-notification clearfix hidden-xs">
            <li>
                <a href="<?=$this->createUrl('message/inbox')?>">
                    <i class="fa fa-envelope fa-lg"></i>
                    <span class="notification-label bounceIn animation-delay4"><?=Message::getUnreadCount('all')?></span>
                </a>
            </li>
            <li>
                <a href="<?=$this->createUrl('user/favoriteList')?>">
                    <i class="fa fa-star fa-lg"></i>
                </a>
            </li>
            <?$myProject = $this->user->projects;?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-file fa-lg"></i>
                </a>
                <ul class="dropdown-menu task dropdown-3">
                    <li><a><?= Yii::t('main','Количество проектов') . ": " . count($myProject)?></a></li>
                    <?foreach($myProject as $project):?>
                        <li>
                            <a class="clearfix" href="<?=$this->createUrl('project/detail',array('id'=>$project->id))?>">
                                <div class="clearfix">
                                    <?=Candy::preview(array($project->logo,'scale'=>'45x45'))?>
                                    <div class="detail">
                                        <strong><?= CHtml::encode($project->name)?></strong>
                                        <p class="no-margin">
                                            <?=$project->complete?> %
                                        </p>
                                    </div>
                                </div>
                                <div class="progress progress-striped" style="margin: 5px 10px 0 10px;">
                                    <div class="progress-bar progress-bar-success" style="width:<?=$project->complete?>%"></div>
                                </div>
                            </a>
                        </li>
                    <?endforeach;?>
                </ul>
            </li>
            <!--li class="profile dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <strong>John Doe</strong>
                    <span><i class="fa fa-chevron-down"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="clearfix" href="#">
                            <img src="img/user.jpg" alt="User Avatar">
                            <div class="detail">
                                <strong>John Doe</strong>
                                <p class="grey">John_Doe@email.com</p>
                            </div>
                        </a>
                    </li>
                    <li><a tabindex="-1" href="profile.html" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
                    <li><a tabindex="-1" href="gallery.html" class="main-link"><i class="fa fa-picture-o fa-lg"></i> Photo Gallery</a></li>
                    <li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
                </ul>
            </li-->
        </ul>
    </div><!-- /top-nav-->

    <aside class="fixed skin-6">
        <div class="sidebar-inner scrollable-sidebars">
            <div class="size-toggle">
                <a class="btn btn-sm" id="sizeToggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
                    <i class="fa fa-power-off"></i>
                </a>
            </div><!-- /size-toggle -->
            <div class="user-block clearfix">
                <?=Candy::preview(array($this->user->logo, 'scale' => '45x45'))?>
                <div class="detail">
                    <strong><?=$this->user->login?></strong>
                    <?$types = User::getUserType();?>
                    <div><?= $this->user->name?></div>
                    <div><?= $types[$this->user->type]?></div>
                    <?if(!empty($this->user->company_name)){?>
                    <div><?= $this->user->company_name?></div>
                    <?}?>
                    <br>
                    <div>Баланс <strong><?=$this->getBalance()->value? $this->getBalance()->value : 0?></strong> <i class="fa fa-rub fa-lg"></i></div>
                </div>
            </div><!-- /user-block -->
            <?php $form=$this->beginWidget('CActiveForm', array(
                'action' => $this->createUrl('site/search'),
                'method' => 'get',
                'htmlOptions'=>array('class'=>'search-block hidden'))); ?>
                <div class="input-group">
                    <?= CHtml::textField('search','', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('main', 'найти') . '...'))?>
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            <?php $this->endWidget(); ?>
            <div class="main-menu">
                <ul>
                    <li <?=$this->uniqueid=='user'?'class="active"':''?>>
                        <a href="<?=$this->createUrl('user/index')?>">
								<span class="menu-icon">
									<i class="fa fa-desktop fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Лента')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li <?=$this->uniqueid=='message'?'class="active"':''?>>
                        <a href="<?=$this->createUrl('message/inbox')?>">
								<span class="menu-icon">
									<i class="fa fa-envelope fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Сообщения')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$this->createUrl('user/favoriteList')?>">
								<span class="menu-icon">
									<i class="fa fa-star fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Избранное')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
								<span class="menu-icon">
									<i class="fa fa-bar-chart fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Индексы')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$this->createUrl('user/profile')?>">
								<span class="menu-icon">
									<i class="fa fa-user fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Профиль')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$this->createUrl('user/projectList')?>">
								<span class="menu-icon">
									<i class="fa fa-file fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Проекты')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon">
                                <i class="fa fa-group fa-lg"></i>
                            </span>
                            <span class="text">
                                <?=Yii::t('main','Группы')?>
                            </span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$this->createUrl('banner/index')?>">
								<span class="menu-icon">
									<i class="fa fa-bullhorn fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Реклама')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
								<span class="menu-icon">
									<i class="fa fa-book fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Услуги портала')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                </ul>
            </div><!-- /main-menu -->
        </div><!-- /sidebar-inner -->
    </aside>

    <div id="main-container">
        <div id="breadcrumb">
            <?$this->renderPartial('/partial/_breadcrumbsBootstrap')?>
        </div><!-- breadcrumb -->
        <?= $content; ?>
    </div><!-- /main-container -->
</div><!-- /wrapper -->

<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>

<!-- Logout confirmation -->
<div class="custom-popup width-100" id="logoutConfirm">
    <div class="padding-md">
        <h4 class="m-top-none"> Вы хотите выйти?</h4>
    </div>

    <div class="text-center">
        <a class="btn btn-success m-right-sm" href="<?=$this->createUrl('user/logout')?>">Выйти</a>
        <a class="btn btn-danger logoutConfirm_close">Отмена</a>
    </div>
</div>
</body>
</html>
