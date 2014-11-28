<!DOCTYPE html>
<html class=" js no-touch localstorage svg">
<head>

    <?
    Yii::app()->clientScript->registerCssFile('/css/normalize.css');
    Yii::app()->clientScript->registerCssFile('/css/style.css');
    Yii::app()->clientScript->registerCssFile('/css/admin.css');
    Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.fancybox.css');

    Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);

    Yii::app()->clientScript->registerScriptFile('/js/root.js', CClientScript::POS_END);

    Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
    Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
    ?>
    <link href="/css/admin/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <!-- / theme file [required] -->
    <link href="/css/admin/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet"
          type="text/css">
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/css/admin/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <!-- / demo file [not required!] -->
    <link href="/css/admin/demo.css" media="all" rel="stylesheet" type="text/css">
    <title><?php echo isset($this->pageCaption) ? $this->pageCaption : Yii::app()->name; ?></title>
    <meta charset="utf-8">

    <?Yii::app()->clientScript->registerScriptFile('/js/admin/bootstrap.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/admin/theme.js', CClientScript::POS_END);?>
    <?//Yii::app()->clientScript->registerScriptFile('/js/jquery.jgrowl.min.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/admin/admin.js', CClientScript::POS_END);?>
</head>
<body class="contrast-red main-nav-opened">
<header>
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="/">
            <img style="margin-top: 5px;" height="30" class="logo" alt="Flatty"
                 src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
        </a>
        <ul class="nav">
            <li class="dropdown dark user-menu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <img height="30" alt="admin" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
                    <span class="user-name">admin</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/admin/logout">
                            <i class="icon-signout"></i>
                            <?= Yii::t('main','Выйти')?>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<div id="wrapper">
    <div id="main-nav-bg"></div>
    <nav id="main-nav">
        <div class="navigation">
            <ul class="nav nav-stacked">
                <li class="">
                    <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Region').'</span>',array('adminRegion/index'),array('class'=>$this->mainMenuActiveId=='region'?'in':''))?>
                </li>
                <li class="">
                    <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Project').'</span>',array('adminProject/index'),array('class'=>$this->mainMenuActiveId=='project'?'in':''))?>
                </li>
                <li class="">
                    <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','News').'</span>',array('adminNews/index'),array('class'=>$this->mainMenuActiveId=='news'?'in':''))?>
                </li>
                <li class="">
                    <?php echo CHtml::link('<i class="icon-cog"></i><span>'.Yii::t('main','Analytics').'</span>',array('adminAnalytics/index'),array('class'=>$this->mainMenuActiveId=='analytics'?'in':''))?>
                </li>
            </ul>
        </div>
    </nav>
    <section class="admin-page" id="content">
        <div class="container">
            <div class="row" id="content-wrapper">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-header">
                                <h1 class="pull-left">
                                    <i class="icon-<?=$this->pageIcon?>"></i>
                                    <span><?=$this->pageCaption?></span>
                                </h1>

                                <div class="pull-right">
                                    <!--ul class="breadcrumb">
                                        <li>
                                            <a href="#">
                                                <i class="icon-bar-chart"></i>
                                            </a>
                                        </li>
                                        <li class="separator">
                                            <i class="icon-angle-right"></i>
                                        </li>
                                        <li>Layouts</li>
                                        <li class="separator">
                                            <i class="icon-angle-right"></i>
                                        </li>
                                        <li class="active">Closed navigation</li>
                                    </ul-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $content; ?>

                </div>
            </div>
        </div>
    </section>
</div>

</body>
</html>