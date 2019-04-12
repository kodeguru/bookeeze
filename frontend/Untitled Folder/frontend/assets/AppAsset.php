<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/frontend/assets';
    public $css = [
        // 'css/bootstrap.css',
        'css/tmpl.css',
        'css/style.css',
        'css/ascarousel.css',
        'css/sequence.css',
        'css/superfish.css',
        'css/custom.css',
        //'css/site.css',
        'css/css.css',
    ];
    public $js = [
        // 'js/jquery-noconflict.js',
        // 'js/jquery-migrate.js',
        'js/caption.js',
       
        'js/popup.js',
        'js/main.js',
        //'js/superfish.js',
        //'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
    //public $cssOptions = ['media' => 'print'];
}
