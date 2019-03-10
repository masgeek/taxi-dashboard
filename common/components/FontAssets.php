<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 08-Aug-18
 * Time: 2:28 PM
 */

namespace common\components;


use yii\web\AssetBundle;

class FontAssets extends AssetBundle
{
    /* ------------------------------------------------------ */
    /* ############### 1. GOOGLE FONTS IMPORT ############### */
    /* ------------------------------------------------------ */

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700',
        '//fonts.googleapis.com/css?family=Roboto:300,400,500,700',
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
        '//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700',
        '//fonts.googleapis.com/css?family=Lato:300,400,700'
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}