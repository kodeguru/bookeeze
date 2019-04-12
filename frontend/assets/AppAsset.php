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
         'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700',

          // <!-- Libraries CSS Files -->
          'css/font-awesome.min.css',
          'css/animate.min.css',
          'css/ionicons.min.css',
          'css/owl.carousel.min.css',
          'css/lightbox.min.css',
          'css/plugins.min.css',

          // <!-- Main Stylesheet File -->
          'css/style.css',
          'css/custom.css',
    ];
    public $js = [
        'js/easing.min.js',
        'js/hoverIntent.js',
        'js/superfish.min.js',
        'js/wow.min.js',
        'js/lightbox.min.js',
        // 'js/waypoints.min.js',
        'js/counterup.min.js',
        'js/owl.carousel.min.js',
        'js/isotope.pkgd.min.js',
        'js/jquery.touchSwipe.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
