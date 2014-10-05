<?php
require(dirname(__FILE__) . '/protected/config/local.php');
require(dirname(__FILE__) . '/protected/config/version.php');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../frameworks/'.YII_VERSION.'/framework/yii.php';
if (!isset($config)) {
    $config = dirname(__FILE__) . '/protected/config/main.php';
}

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
