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
    public $css = [
        'css/bootstrap-extend.css',
        'css/master_style.css',
        'css/skins/_all-skins.css',
        //'assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css',
        //'assets/vendor_components/morris.js/morris.css',
        //'assets/vendor_components/datatable/datatables.min.css'
    ];
    
    public $js = [
        //'assets/vendor_components/jquery-ui/jquery-ui.js',
        //'assets/vendor_components/popper/dist/popper.min.js',
        //'assets/vendor_components/moment/min/moment.min.js',
        //'assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js',
        'assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js',
        //'assets/vendor_components/echarts/dist/echarts-en.min.js',
        //'assets/vendor_components/echarts/echarts-liquidfill.min.js',
        //'assets/vendor_components/fastclick/lib/fastclick.js',
        //'assets/vendor_components/raphael/raphael.min.js',
        //'assets/vendor_components/morris.js/morris.min.js',
        //'assets/vendor_components/datatable/datatables.min.js',
        'js/template.js',
        #'js/pages/dashboard2.js',
        'js/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
