<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
/* TODO PE APLICATIE
 * https://github.com/Tigrov/yii2-country - de adaugat orase si judete pe formulare
 * http://www.yiiframework.com/doc-2.0/guide-tutorial-performance-tuning.html - performance tuning
 * https://www.sitepoint.com/upload-large-files-in-php/ - large file upload
 *  */
//ini_set('upload_max_filesize', '400M');
//ini_set('post_max_size', '400M');
//ini_set('max_input_time', 1200); //20 minute
//ini_set('max_execution_time', 1200);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
