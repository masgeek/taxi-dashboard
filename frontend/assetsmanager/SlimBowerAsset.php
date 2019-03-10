<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 22-Feb-18
 * Time: 15:02
 */

namespace frontend\assetsmanager;

use common\components\MyAssetBundle;

/**
 * Bower theme asset bundle.
 *
 * @author Sammy B <barsamms@gmail.com>
 * @since 2.0
 */
class SlimBowerAsset extends MyAssetBundle
{
    public $sourcePath = '@bower';
    public $publishOptions = [
        'forceCopy' => false,
        'linkAssets' => true,
    ];

    public $css = [
       'ionicons/css/ionicons.css'
    ];


    public $js = [
        'perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js',
        'jquery.cookie/jquery.cookie.js',
        //'ionicons/dist/ionicons.js'
    ];
}