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
                    <?php foreach($this->getSideMenu() as $item){
                        if(!$this->user->can($item['id'])) continue;
                        if (isset($item['items'])){?>
                            <li class="openable <?= in_array($item['id'], $this->activeMenu) ? 'active open' : ''?>">
                                <a href="#">
								<span class="menu-icon">
									<i class="fa fa-fw fa-<?=$item['icon']?> fa-lg"></i>
								</span>
								<span class="text">
									<?=$item['title']?>
								</span>
                                    <span class="menu-hover"></span>
                                </a>
                                <ul class="submenu">
                                    <?php foreach($item['items'] as $subItem){?>
                                        <li class="<?= in_array($subItem['id'], $this->activeMenu) ? 'active' : ''?>">
                                            <?= CHtml::link("<span class='submenu-label'><i class='fa fa-{$subItem['icon']} fa-fw'></i> " .$subItem['title'] . "</span>" . (isset($subItem['badge']) ? "<span class='badge badge-info bounceIn animation-delay2 pull-right'>{$subItem['badge']}</span>" : ''), $this->createUrl($subItem['url']))?>

                                        </li>
                                    <?php }?>
                                </ul>
                            </li>
                        <?php } else {?>
                            <li class="<?= in_array($item['id'], $this->activeMenu) ? 'active' : ''?>">
                                <a href="<?=$this->createUrl($item['url'])?>">
								<span class="menu-icon">
									<i class="fa fa-fw fa-<?=$item['icon']?> fa-lg"></i>
								</span>
								<span class="text">
									<?=$item['title']?>
								</span>
                                    <span class="menu-hover"></span>
                                </a>
                            </li>
                        <?php }
                    }?>
                </ul>
            </div><!-- /main-menu -->
        </div><!-- /sidebar-inner -->
    </aside>

    <div id="main-container" style="margin-right: 0px;">

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
