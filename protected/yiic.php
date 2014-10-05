<?php
require(dirname(__FILE__) . '/config/local.php');
require(dirname(__FILE__) . '/config/version.php');

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../../frameworks/'.YII_VERSION.'/framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
