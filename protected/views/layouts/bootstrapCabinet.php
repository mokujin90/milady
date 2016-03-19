<?php
/* @var $this BaseController */
Yii::app()->clientScript->registerCssFile('/css/theme/bootstrap-datepicker3.css');
Yii::app()->clientScript->registerCssFile('/css/theme/bootstrap.min.css');
Yii::app()->clientScript->registerCssFile('/css/theme/font-awesome.min.css');
Yii::app()->clientScript->registerCssFile('/css/theme/pace.css');
Yii::app()->clientScript->registerCssFile('/css/theme/app.css');
Yii::app()->clientScript->registerCssFile('/css/theme/app-skin.css');
Yii::app()->clientScript->registerCssFile('/css/theme/app-header.css');
Yii::app()->clientScript->registerCssFile('/css/theme/jcarousel.responsive.css');
Yii::app()->clientScript->registerCssFile('/css/vendor/chosen/chosen.css');

#JS
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile('/js/theme/bootstrap.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/modernizr.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/pace.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.popupoverlay.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.slimscroll.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.cookie.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.jcarousel.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/jquery.jcarousel.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/bootstrap-datepicker.en-GB.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/chosen.jquery.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.maskedinput.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/theme/app.js', CClientScript::POS_END);

Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerCoreScript('ckeditor');
Yii::app()->clientScript->registerCoreScript('sroller');
Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
Yii::app()->clientScript->registerScriptFile('/js/confirmDialog.js', CClientScript::POS_END);

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

<header class="header bg-full-width grey-bg">
    <div class="content">
        <a class="logo" href="/"></a>
        <?$this->renderPartial('../layouts/_headerMenu', array('menu' => $this->getMenu()));?>
        <div class="pull-right-menu">
            <?$this->renderPartial('../layouts/_searchMenu');?>
            <?$this->renderPartial('../layouts/_userMenu');?>
            <div class="lang">
                <span class="lang__selected">ru</span>
            </div>
        </div>
    </div><!--content-->

</header>
<div id="wrapper" class="preload">
    <aside class="fixed skin-6">
        <div class="sidebar-inner">
            <div class="user-block clearfix">
                <?=Candy::preview(array($this->user->logo, 'scale' => '45x45'))?>
                <div class="detail">
                    <?$types = User::getUserType();?>
                    <div><?= $this->user->name?></div>
                    <div><?= $types[$this->user->type]?></div>
                    <?if(!empty($this->user->company_name)){?>
                    <div><?= $this->user->company_name?></div>
                    <?}?>
                </div>
            </div>
            <div class="user-block clearfix">
                <div class="detail" data-toggle="modal" data-target="#add_money" style="cursor: pointer;">Баланс <strong><?=$this->getBalance()->value? $this->getBalance()->value : 0?></strong> <i class="fa fa-rub fa-lg"></i></div>
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
                    <li <?=$this->uniqueid=='user' && $this->action->Id == 'index'?'class="active"':''?>>
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
                                    <span class="badge badge-danger bounceIn animation-delay1"><?=Message::model()->count('user_to = :user && is_read = 0', array('user' => Yii::app()->user->id));?></span>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li <?=$this->uniqueid=='user' && $this->action->Id == 'favoriteList' ?'class="active"':''?>>
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
                    <li <?=$this->uniqueid=='user' && $this->action->Id == 'quotes' ?'class="active"':''?>>
                        <a href="<?=$this->createUrl('user/quotes')?>">
								<span class="menu-icon">
									<i class="fa fa-bar-chart fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Индексы')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li <?=$this->uniqueid=='user' && $this->action->Id == 'profile' ?'class="active"':''?>>
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
                    <?if($this->user->type==User::T_INITIATOR){?>
                    <li <?=$this->uniqueid=='user' && $this->action->Id == 'projectList' ?'class="active"':''?>>
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
                    <?}?>
                    <li <?=$this->uniqueid=='group' ?'class="active"':''?>>
                        <a href="<?=$this->createUrl('group/index')?>">
                            <span class="menu-icon">
                                <i class="fa fa-group fa-lg"></i>
                            </span>
                            <span class="text">
                                <?=Yii::t('main','Группы')?>
                            </span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                    <li <?=$this->uniqueid=='banner' ?'class="active"':''?>>
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
                    <li <?=($this->uniqueid=='user' && ($this->action->Id == 'payHistory' || $this->action->Id == 'service' || $this->action->Id == 'addBalance')) ?'class="active"':''?>>
                        <a href="<?=$this->createUrl('user/payHistory')?>">
								<span class="menu-icon">
									<i class="fa fa-usd fa-lg"></i>
								</span>
								<span class="text">
									<?=Yii::t('main','Услуги')?>
								</span>
                            <span class="menu-hover"></span>
                        </a>
                    </li>
                </ul>
                <?$this->widget('BannerWidget',array('regionId'=>$this->user->region ? $this->user->region->id : BaseController::DEFAULT_CURRENT_REGION, 'bannerCount' => 2, 'url' => 'banner/sideView'))?>
            </div><!-- /main-menu -->
        </div><!-- /sidebar-inner -->
    </aside>
    <aside class="fixed right-fixed hidden-sm hidden-xs">
        <div class="sidebar-inner scrollable-sidebars" style="padding-top: 20px;">
            <?if($this->user->profileCompletion() < 100 && empty($_COOKIE['profile_info_hide'])):?>
                <div class="col-sm-12 hide-wrapper">
                    <div class="panel-stat3 bg-danger">
                        <a href="/user/profile" class="text-white">
                            <h2 class="m-top-none" id="userCount"><?=$this->user->profileCompletion()?>%</h2>
                            <h5>Профиль</h5>
                            <span>Заполните профиль, чтобы получать больше предложений</span>
                            <div class="stat-icon">
                                <i class="fa fa-user fa-2x"></i>
                            </div>
                            <div class="refresh-button hide-block" data-cookie="profile_info_hide">
                                <i class="fa fa-close"></i>
                            </div>
                        </a>
                    </div>
                </div><!-- /.col -->
            <?endif?>
            <?if($this->user->type == 'initiator' && empty($_COOKIE['view_info_hide'])):?>
                <div class="col-sm-12 hide-wrapper">
                    <div class="panel-stat3 bg-info">
                        <h2 class="m-top-none"><?=$this->user->getProjectViews()?></h2>
                        <h5>Просмотры<br>ваших проектов</h5>
                        <div class="stat-icon">
                            <i class="fa fa-eye fa-2x"></i>
                        </div>
                        <div class="refresh-button hide-block" data-cookie="view_info_hide">
                            <i class="fa fa-close"></i>
                        </div>
                    </div>
                </div><!-- /.col -->
            <?endif?>
            <?if($this->user->type == 'initiator' && empty($_COOKIE['response_info_hide'])):?>
                <div class="col-sm-12 hide-wrapper">
                    <div class="panel-stat3 bg-warning">
                        <h2 class="m-top-none" id="orderCount"><?=$this->user->getProjectReply()?></h2>
                        <h5>Отклики на ваши проекты</h5>
                        <div class="stat-icon">
                            <i class="fa fa-comment fa-2x"></i>
                        </div>
                        <div class="refresh-button hide-block" data-cookie="response_info_hide">
                            <i class="fa fa-close"></i>
                        </div>
                    </div>
                </div><!-- /.col -->
            <?endif?>
            <div style="clear: both;"></div>
            <?if($this->user->type == 'initiator'):?>
                <?$count = 0;?>
                <?if(count($this->user->projectViewers)) {?>
                    <div class="grey-container shortcut-wrapper">
                        <p>Смотрели проекты:</p>
                        <div class="investors-wrap">
                            <?foreach($this->user->projectViewers as $item) {?>
                                <?if(++$count > 6) break;?>
                                <a href="<?=$item->viewer->getUrl()?>"><?=$item->viewer->logo ? Candy::preview(array($item->viewer->logo, 'scale' => '40x40')) : '<img src="http://lorempixel.com/40/40/"/>'?></a>
                            <?}?>
                        </div>
                    </div>
                <?}?>

            <?$count = 0;?>
            <?if(count($this->user->profileViewers)) {?>
                <div class="grey-container shortcut-wrapper">
                    <p>Вами интересуются:</p>
                    <div class="investors-wrap">
                        <?foreach($this->user->profileViewers as $item) {?>
                            <?if(++$count > 6) break;?>
                            <a href="<?=$item->viewer->getUrl()?>"><?=$item->viewer->logo ? Candy::preview(array($item->viewer->logo, 'scale' => '40x40')) : '<img src="/images/markup/small-city.png"/>'?></a>
                        <?}?>
                    </div>
                </div>
            <?}?>
            <?endif?>
        </div><!-- /sidebar-inner -->
    </aside>
    <div id="main-container">
        <?php if (Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger margin-md">
                <?php echo Yii::app()->user->getFlash('error')?>
            </div>
        <?endif?>
        <div id="breadcrumb">
            <?$this->renderPartial('/partial/_breadcrumbsBootstrap')?>
        </div><!-- breadcrumb -->
        <?= $content; ?>
    </div><!-- /main-container -->
</div><!-- /wrapper -->

<!-- Modal -->
<div class="modal fade" id="add_money" tabindex="-1" role="dialog" aria-labelledby="add_money">
    <div class="modal-dialog" role="document">
        <?php $form=$this->beginWidget('CActiveForm',array('action'=>$this->createUrl('money/add'),'htmlOptions'=>array('class'=>'form-horizontal'))); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Пополнение средств</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?=CHtml::label('Сумма','summary_money',array('class'=>'col-lg-2 control-label'))?>
                        <div class="col-lg-10">
                            <?=CHtml::textField('add_value','100',array('id'=>'summary_money','class'=>'form-control'))?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                    <?=CHtml::submitButton('Пополнить',array('class'=>'btn btn-primary'))?>
                </div>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>



<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>

<!-- Logout confirmation -->
<!--div class="custom-popup width-100" id="logoutConfirm">
    <div class="padding-md">
        <h4 class="m-top-none"> Вы хотите выйти?</h4>
    </div>

    <div class="text-center">
        <a class="btn btn-success m-right-sm" href="<?=$this->createUrl('user/logout')?>">Выйти</a>
        <a class="btn btn-danger logoutConfirm_close">Отмена</a>
    </div>
</div-->
</body>
</html>
