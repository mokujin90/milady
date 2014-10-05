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
);

return CMap::mergeArray($frontendArray, $backendArray);
?>
