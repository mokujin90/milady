<?php

$commonArray = require(dirname(__FILE__).DIRECTORY_SEPARATOR.'common.php');

$consoleArray =  array(
    // application components
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
    ),
);

if (isset($log_sql)) {
    $consoleArray['components']['log']['routes'][] = $log_sql;
}

return CMap::mergeArray($commonArray,$consoleArray);
