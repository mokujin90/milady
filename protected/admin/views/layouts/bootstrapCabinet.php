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
Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
Yii::app()->clientScript->registerScriptFile('/js/root.js', CClientScript::POS_END);
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
            <span>ADMIN</span>
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

        <ul class="nav-notification clearfix hidden-xs">
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
            <div class="user-block clearfix">
                <div class="detail">
                    <div>Admin</div>
                </div>
            </div>
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
                    <li <?=$this->mainMenuActiveId=='region'?'class="active"':''?>>
                        <a href="<?=$this->createUrl('adminRegion/index')?>">
								<span class="menu-icon">
									<i class="fa fa-cog fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Регионы')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li <?=$this->mainMenuActiveId=='city'?'class="active"':''?>>
                        <a href="<?=$this->createUrl('adminCity/index')?>">
								<span class="menu-icon">
									<i class="fa fa-cog fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Города')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Проекты').'</span>',array('adminProject/index'),array('class'=>$this->mainMenuActiveId=='project'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Новости').'</span>',array('adminNews/index'),array('class'=>$this->mainMenuActiveId=='news'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Аналитика').'</span>',array('adminAnalytics/index'),array('class'=>$this->mainMenuActiveId=='analytics'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Сообщения').'</span>',array('adminMessages/inbox'),array('class'=>$this->mainMenuActiveId=='messages'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','События').'</span>',array('adminEvent/index'),array('class'=>$this->mainMenuActiveId=='event'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Контент').'</span>',array('adminContent/index'),array('class'=>$this->mainMenuActiveId=='content'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Библиотека').'</span>',array('adminLibrary/index'),array('class'=>$this->mainMenuActiveId=='library'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Законодательство').'</span>',array('adminLaw/index'),array('class'=>$this->mainMenuActiveId=='law'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Обратная связь').'</span>',array('adminFeedback/index'),array('class'=>$this->mainMenuActiveId=='feedback'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Слайдер').'</span>',array('adminSlider/index'),array('class'=>$this->mainMenuActiveId=='slider'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Баннеры').'</span>',array('adminBanner/index'),array('class'=>$this->mainMenuActiveId=='banner'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Пользователи').'</span>',array('adminUser/index'),array('class'=>$this->mainMenuActiveId=='user'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Статические баннеры').'</span>',array('adminStaticBanner/index'),array('class'=>$this->mainMenuActiveId=='static'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Настройки').'</span>',array('adminSetting/index'),array('class'=>$this->mainMenuActiveId=='setting'?'in':''))?>
                    </li>
                    <li class="">
                        <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Парсинг новостей').'</span>',array('adminParserLog/index'),array('class'=>$this->mainMenuActiveId=='parserLog'?'in':''))?>
                    </li>
                </ul>

            </div><!-- /main-menu -->
        </div><!-- /sidebar-inner -->
    </aside>

    <div id="main-container">

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
