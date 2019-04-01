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
    public $sourcePath = __DIR__ . '/../myassets';
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';


    public $publishOptions = [
        'forceCopy' => false,
        'linkAssets' => true,
    ];
    public $css = [
        'css/bootstrap-extend.css',
        'css/master_style.css',
        'css/skins/_all-skins.css',
    ];

    public $js = [
        'js/template.js',
        #'js/pages/dashboard2.js',
        'js/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yidas\yii\fontawesome\FontawesomeAsset',
        'backend\assetmanager\SuperBowerAsset'
    ];
}
