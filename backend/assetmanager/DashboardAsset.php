<?php
/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 3/30/2019
 * Time: 10:02 PM
 */

namespace backend\assetmanager;


use yii\web\AssetBundle;

class DashBoardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $publishOptions = [
        'forceCopy' => false,
        'linkAssets' => true,
    ];

    public $css = [
        //'//fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
        //'simple-line-icons/css/simple-line-icons.css',
        //'material-design-iconic-font/dist/css/material-design-iconic-font.css',
        //'assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css',
        'myassets/assets/vendor_components/morris.js/morris.css',
        'myassets/assets/vendor_components/datatable/datatables.min.css'
    ];


    public $js = [
        //'assets/vendor_components/jquery-ui/jquery-ui.js',
        //'assets/vendor_components/popper/dist/popper.min.js',
        //'assets/vendor_components/moment/min/moment.min.js',
        //'assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js',
        //'assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js',
        'myassets/assets/vendor_components/echarts/dist/echarts-en.min.js',
        'myassets/assets/vendor_components/echarts/echarts-liquidfill.min.js',
        'myassets/assets/vendor_components/fastclick/lib/fastclick.js',
        'myassets/assets/vendor_components/raphael/raphael.min.js',
        'myassets/assets/vendor_components/morris.js/morris.min.js',
        'myassets/assets/vendor_components/datatable/datatables.min.js',
        //'myassets/js/demo.js',
    ];

    public $depends = [

    ];
}