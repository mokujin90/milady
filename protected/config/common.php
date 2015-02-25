<?php
require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'local.php');
Yii::setPathOfAlias('crud', dirname(__FILE__) . '/../components/crud');
Yii::setPathOfAlias('external', dirname(__FILE__).'/../controllers/external');
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

        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
        ),

        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:nw+>' => 'gii/<controller>',
                'gii/<controller:nw+>/<action:nw+>' => 'gii/<controller>/<action>',

                "http://<regionLatin:[\w-]>.{$hostName}/<controller:\w+>/<action:\w+>" => '<controller>/<action>',

                "http://<regionLatin:[\w-]>.{$hostName}/user/projectList" => 'user/projectList',
                'user/projectList' => 'user/projectList',

                "http://<regionLatin:[\w-]>.{$hostName}/project/index" => 'project/index',
                'project/index' => 'project/index',

                "http://<regionLatin:[\w-]>.{$hostName}/user/index" => 'user/index',
                'user/index' => 'user/index',

                "http://<regionLatin:[\w-]>.{$hostName}/investor" => 'investor/index',
                'investor' => 'investor/index',
                'support-innovation/tenders/<view:[\w-]+>/<el1:[\w-]+>/<el2:[\w-]+>/<el3:[\w-]+>/<el4:[\w-]+>/<el5:[\w-]+>'=>'contest/index',
                'support-innovation/tenders/<view:[\w-]+>/<el1:[\w-]+>/<el2:[\w-]+>/<el3:[\w-]+>/<el4:[\w-]+>'=>'contest/index',
                'support-innovation/tenders/<view:[\w-]+>/<el1:[\w-]+>/<el2:[\w-]+>/<el3:[\w-]+>'=>'contest/index',
                'support-innovation/tenders/<view:[\w-]+>/<el1:[\w-]+>/<el2:[\w-]+>'=>'contest/index',
                'support-innovation/tenders/<view:[\w-]+>/<el1:[\w-]+>'=>'contest/index',
                'support-innovation/tenders/<view:[\w-]+>'=>'contest/index',
                'support-innovation/tenders'=>'contest/index',
                '/' => 'site/index',
                'admin' =>'admin/login',

                '<urlLatine:[\w-]+>'=>'project/find'
            ),
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'firstPageLabel' => '',
                    'lastPageLabel' => '',
                    'header' => '',
                    'itemCount' => 5,
                    'nextPageLabel' => Yii::t('main', 'Вперед'),
                    'prevPageLabel' => Yii::t('main', 'Назад'),
                    'htmlOptions' => array(
                        'class' => 'iipPager'
                    ),
                )
            )
        )
    ),
    'params' => array_merge($local_params,array(
        'host' => preg_replace('/:\d+$/', '', preg_replace('/^www\./', '', $_SERVER["HTTP_HOST"])),
        'cookieDomain' => '.' . preg_replace('/:\d+$/', '', preg_replace('/^www\./', '', $_SERVER["HTTP_HOST"])),

        'adminEmail' => $adminEmail,
        'fromEmail' => 'termin@wconsults.ru',
        'fromName' => 'Iip',
        'defaultPageSize' => 10,
    ))
);
