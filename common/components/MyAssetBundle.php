<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 15-Aug-18
 * Time: 3:14 PM
 */

namespace common\components;


use yii\web\AssetBundle;

class MyAssetBundle extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => false,
        'linkAssets' => true,
    ];

    public $css = [
    ];
    public $js = [
    ];

    public $depends = [
    ];
}