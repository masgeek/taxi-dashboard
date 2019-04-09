<?php
/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 3/30/2019
 * Time: 10:02 PM
 */

namespace backend\assetmanager;


use yii\web\AssetBundle;

class Bootstrap4Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $css = ['myassets/css/site.css'];
    public $js = [];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}