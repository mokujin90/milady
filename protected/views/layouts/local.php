<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
$hostName = 'iip.wconsults.ru';
$adminEmail = 'mokujin@inbox.ru';

$local_db['name'] = "iip_iip_test";
$local_db['host'] = '127.0.0.1';
$local_db['username'] = 'iip_iip_test';
$local_db['password'] = 'VcSRmTNQ50';
$local_params = array(
    'robokassa' => array(
        'login'=>'iip-test',
        'pass1'=>'pass12345',
        'pass2'=>'pass23456',
        'actionUrl'=>'https://auth.robokassa.ru/Merchant/Index.aspx',
    )
);
$db_connection_array = array(
    'class' => 'CDbConnection',
    'connectionString' => "mysql:host={$local_db['host']};dbname={$local_db['name']}",
    'username' => $local_db['username'],
    'password' => $local_db['password'],
    'charset' => 'utf8',
    /*'enableProfiling'=>true,*/
    'enableParamLogging' => true,
    /*'schemaCachingDuration'=>3600,*/
);
$db_connection_array_baikal = array(
    'class' => 'CDbConnection',
    'connectionString' => "mysql:host={$local_db['host']};dbname=baikal",
    'username' => $local_db['username'],
    'password' => $local_db['password'],
    'charset' => 'utf8',
    /*'enableProfiling'=>true,*/
    'enableParamLogging' => true,
    /*'schemaCachingDuration'=>3600,*/
);

$log_develop_category = array(
    'class' => 'CFileLogRoute',
    'levels' => 'trace',
    'categories' => 'develop',
);

$log_sql_disabled = array(
    'class' => 'CFileLogRoute',
    'categories' => 'system.db.*'
);
$localImageMagick = array(
    // Путь к библиотеке imageMagick (по умолчанию не указывался)
    'params'=>array('directory'=>'/usr/bin'/*'/usr/local/bin'*/),
);

$log_email_disabled = array(
    'class' => 'ExtEmailLogRoute',
    'levels' => 'error, warning',
    'filter' => array('class' => 'CategoryExcludeLogFilter',
                      'categories' => array('exception.CHttpException.404', 'exception.CHttpException.403')),
    'emails' => $adminEmail,
    'subject' => 'error, warning'
);

$gii = array(
    'class' => 'system.gii.GiiModule',
    'password' => '123',
    'ipFilters' => array('127.0.0.1'),
);
