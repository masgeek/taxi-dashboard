<?php
/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 3/30/2019
 * Time: 10:02 PM
 */

namespace common\assetmanager;


use yii\web\AssetBundle;

class SwaggerUiAssets extends AssetBundle
{
    public $sourcePath = '@bower';
    public $publishOptions = [
        'forceCopy' => false,
        'linkAssets' => true,
    ];

    public $css = [
        'swagger-ui-dist/swagger-ui.css'
    ];


    public $js = [
        'swagger-ui-dist/swagger-ui-bundle.js'
    ];
}