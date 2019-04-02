<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assetmanager;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SuperThemeAsset extends AssetBundle
{
    //public $sourcePath = __DIR__ . '/../myassets';
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $publishOptions = [
        'forceCopy' => false,
        'linkAssets' => true,
    ];
    public $css = [
        'myassets/css/bootstrap-extend.css',
        'myassets/css/master_style.css',
        'myassets/css/skins/_all-skins.css',

        'myassets/icons/simple-line-icons/css/simple-line-icons.css',
        'myassets/icons/material-design-iconic-font/css/materialdesignicons.css',
        'myassets/icons/themify-icons/themify-icons.css',
        'myassets/icons/linea-icons/linea.css',
        'myassets/icons/glyphicons/glyphicon.css',
        'myassets/icons/flag-icon/css/flag-icon.css',
        'myassets/icons/cryptocoins-master/webfont/cryptocoins.css',
        'myassets/icons/ionicons/css/ionicons.css',
        'myassets/css/animate/animate.css',

    ];

    public $js = [
        'myassets/js/popper/dist/popper.min.js',
        'myassets/js/jquery-slimscroll/jquery.slimscroll.min.js',
        'myassets/js/template.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yidas\yii\fontawesome\FontawesomeAsset',
        'backend\assetmanager\SuperBowerAsset'
    ];
}
