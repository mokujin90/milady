<?php

$backend = dirname(dirname(__FILE__));
$frontend = dirname($backend);

Yii::setPathOfAlias('adminbackend', $backend);
Yii::setPathOfAlias('frontend', $frontend);

$frontendArray = require($frontend . '/config/main.php');

// использовать clientScript по умолчанию
unset($frontendArray['components']['clientScript']);

// This is the main Web application backend configuration. Any writable
// CWebApplication properties can be configured here.
$backendArray = array(
    'name' => 'Управление',
    'controllerPath' => $backend . '/controllers',
    'viewPath' => $backend . '/views',
    'layoutPath' => $backend . '/views/layouts',

    'defaultController' => 'admin/login',
    'homeUrl' => '/admin',


    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        //'application.extensions.image.*',
        'adminbackend.models.*',
        'adminbackend.components.*',
        'adminbackend.controllers.*',
        'application.helpers.*',
    ),
    'components' => array(
        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => array(
                '/admin' => 'admin/login',
                '/admin/logout' => 'admin/logout',
                '/admin/<_c:(.*)>/<_a:(.*)>' => 'admin<_c>/<_a>',
                '/admin/<_c:(.*)>/' => 'admin<_c>/index',
            )
        ),
        'clientScript'=>array(
            'packages' => array(
                'jquery.ui' => array(
                    'baseUrl'=> '/', //обязательной параметр, без него все считывается из assets
                    'js'=>array('js/vendor/jquery-ui.min.js'),
                    'css' => array('css/vendor/jquery-ui.min.css')
                ),
                'tinymce' => array(
                    'baseUrl'=> '/',
                    'js'=>array(
                        'js/vendor/tiny_mce/jquery.tinymce.js',
                        'js/vendor/tiny_mce/tiny_mce.js',
                    ),
                    'depends'=>array('jquery'),
                ),
                'ckeditor' => array(
                    'baseUrl'=> '/',
                    'js'=>array(
                        'js/vendor/ckeditor/ckeditor.js',
                    ),
                    'depends'=>array('jquery'),
                ),
            )
        ),
        'errorHandler' => array(
            //'errorAction' => 'admin/error'
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'header' => '',
                    'nextPageLabel'=>'Следующая <i class="fa fa-long-arrow-right"></i>',
                    'prevPageLabel'=>'<i class="fa fa-long-arrow-left"></i> Предыдущая',
                    'lastPageLabel'=>'Последняя',
                    'firstPageLabel'=>'Первая',
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'maxButtonCount' => 5,
                    'htmlOptions' => array(
                        'class' => 'pagination',
                    ),
                ),
                'CGridView' => array(
                    'htmlOptions' => array(
                        'class' => 'table-responsive'
                    ),
                    'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
                    'itemsCssClass' => 'table table-striped table-hover',
                    'cssFile' => false,
                    'summaryCssClass' => 'dataTables_info',
                    'summaryText' => 'Showing {start} to {end} of {count} entries',
                    'template' => '{items}<div class="row"><div class="col-md-5 col-sm-12">{summary}</div><div class="col-md-7 col-sm-12">{pager}</div></div><br />',
                ),
            ),
        ),
    ),
);

return CMap::mergeArray($frontendArray, $backendArray);
?>
