<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assetsmanager;

use common\components\MyAssetBundle;

class SlimAsset extends MyAssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'site.css',
        //'slim/ionicons/css/ionicons.css',
        'myassets/slim/css/slim.css',
        //'slim/css/slim.header-one.css', //blue header dark nav bar
        //'slim/css/slim.header-two.css', //dark header light nav bar
        //'slim/css/slim.one.css', //dark theme
    ];
    public $js = [
        'myassets/slim/js/slim.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        '\yii\bootstrap4\BootstrapPluginAsset',
        'yidas\yii\fontawesome\FontawesomeAsset',
        'frontend\assetsmanager\SlimBowerAsset'
    ];
}
