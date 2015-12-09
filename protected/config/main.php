<?php
$commonArray = require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'common.php');


$frontendArray = array(
    'defaultController' => 'site',
    'components' => array(
        'clientScript'=>array(
            'packages' => array(
                'jquery.ui' => array(
                    'baseUrl'=> '/', //обязательной параметр, без него все считывается из assets
                    'js'=>array('js/vendor/jquery-ui.min.js'),
                    'css' => array('css/vendor/jquery-ui.min.css'),
                    'depends'=>array('jquery'),
                ),
                'tinymce' => array(
                    'baseUrl'=> '/',
                    'js'=>array(
                        'js/tinymce/jquery.tinymce.min.js',
                        'js/tinymce/tinymce.min.js',
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
                'sroller' => array(
                    'baseUrl'=> '/',
                    'js'=>array(
                        'js/vendor/jquery.mCustomScrollbar.min.js',
                    ),
                    'css' => array('css/vendor/jquery.mCustomScrollbar.min.css'),
                    'depends'=>array('jquery'),
                ),
            )
        ),
        'errorHandler' => array(
            //'errorAction' => 'site/error'
            //'adminInfo' => CHtml::mailto($adminEmail),
        ),

        'session' => array(
            'autoStart'=>true,
            'cookieParams' => array(
                'domain' => $commonArray['params']['cookieDomain'],
            ),
        ),
        'user' => array(
            'allowAutoLogin' => true,
            'loginUrl' => array('user/login'),
            'stateKeyPrefix' => 'user',
            'identityCookie' => array('domain' => $commonArray['params']['cookieDomain']),
        ),
        'format'=>array(
            'numberFormat'=>array('thousandSeparator'=>' ','decimals'=>1,'decimalSeparator'=>',', ),
        ),
        'adminUser' => array(
            'class' => 'CWebUser',
            'allowAutoLogin' => true,
            /*'autoRenewCookie' => true,*/
            'loginUrl' => array('admin/login'),
            'stateKeyPrefix' => 'admin_user',
            'identityCookie' => array('domain' => $commonArray['params']['cookieDomain']),
        ),

        /*'cache' => array(
            'class' => 'CApcCache',
        ),*/
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    'filter' => array('class' => 'CategoryExcludeLogFilter',
                        'categories' => array('exception.CHttpException.404', 'exception.CHttpException.403'))
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error',
                    'categories' => 'exception.CHttpException.403',
                    'filter' => 'CLogFilter',
                    'logFile' => 'error403.log'
                ),
                /*array(
                    'class' => 'CProfileLogRoute',
                ),*/
            ),
        ),
    ),
);

if (isset($log_develop_category)) {
    $frontendArray['components']['log']['routes'][] = $log_develop_category;
}

if (isset($log_sql)) {
    $frontendArray['components']['log']['routes'][] = $log_sql;
}

if (isset($log_email)) {
    $frontendArray['components']['log']['routes'][] = $log_email;
}

if (isset($gii)) {
    $frontendArray['modules']['gii'] = $gii;
}

/*if (!YII_DEBUG) {
    $frontendArray['components']['errorHandler'] = array(
        'errorAction'=>'site/error',
    );
}*/


return CMap::mergeArray($commonArray, $frontendArray);
