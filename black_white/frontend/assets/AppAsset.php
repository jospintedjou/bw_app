<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/libs/font-awesome.min.css',
		'css/libs/green.css',
		'css/custom.css',
    ];
    public $js = [
		'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
	'\rmrevin\yii\fontawesome\AssetBundle'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}

