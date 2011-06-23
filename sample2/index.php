<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

//MP CONSTANTS
define('MP_CATALOG_STORAGE_PATH', dirname(__FILE__).'/protected/data/row');

require_once($yii);

Yii::createWebApplication($config)->run();

/*/ set the php include path
$libPath=dirname(__FILE__).'/../lib';
set_include_path(
    $libPath . PATH_SEPARATOR .
    get_include_path()
);*/