<?php
require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'local.php');
Yii::setPathOfAlias('crud', dirname(__FILE__).'/../components/crud');
Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yii-chartjs');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Iip',

    // preloading 'log' component
    'preload' => array('log'),
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',

    // autoloading model and component classes
    'import' => array(
        'application.controllers.*',
        'application.models.*',
        'application.models.forms.*',
        'application.components.*',
        'application.components.Stock.*',
        'application.components.framework.*',
        'application.helpers.*',
        'application.extensions.JsTrans.*',
        'application.widgets.*',
        'zii.widgets.jui.*',
        'zii.widgets.grid.*',
    ),

    // application components
    'components' => array(
        'db' => $db_connection_array,

        'image' => array_merge(array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'ImageMagick',
        ), $localImageMagick),
        /*
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
        ),*/

        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'caseSensitive' => true,
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:nw+>' => 'gii/<controller>',
                'gii/<controller:nw+>/<action:nw+>' => 'gii/<controller>/<action>',

                'user/projectList'=>'user/projectList',
                'investor'=>'investor/index',

                '/'=>'site/index',
            ),
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager'=>array(
                    'firstPageLabel'=>'',
                    'lastPageLabel'=>'',
                    'header'=>'',
                    'itemCount'=>5,
                    'nextPageLabel'=>Yii::t('main','Вперед'),
                    'prevPageLabel' => Yii::t('main','Назад'),
                    'htmlOptions' => array(
                        'class' => 'iipPager'
                    ),
                )
            )
        )
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'host' => preg_replace('/:\d+$/', '', preg_replace('/^www\./', '', $_SERVER["HTTP_HOST"])),
        'cookieDomain' => '.' . preg_replace('/:\d+$/', '', preg_replace('/^www\./', '', $_SERVER["HTTP_HOST"])),

        'adminEmail' => $adminEmail,
        'fromEmail' => 'robot@example.com',
        'fromName' => 'Iip',
    ),
);
