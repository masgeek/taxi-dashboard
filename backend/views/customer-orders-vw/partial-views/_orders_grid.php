<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use common\helper\OrderHelper;
use common\helper\APP_UTILS;
/* @var $this yii\web\View */
/* @var $searchModel \common\models\search\VwCustomerOrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$isFa = true;

$exportConfig = [
    ExportMenu::FORMAT_HTML => false,
    ExportMenu::FORMAT_CSV => [
        'label' => Yii::t('app', 'CSV'),
        'icon' => $isFa ? 'file-code-o' : 'floppy-open',
        'iconOptions' => ['class' => 'text-primary'],
        'linkOptions' => [],
        'options' => ['title' => Yii::t('app', 'Comma Separated Values')],
        'alertMsg' => Yii::t('app', 'The CSV export file will be generated for download.'),
        'mime' => 'application/csv',
        'extension' => 'csv',
        //'writer' => 'CSV'
    ],
    ExportMenu::FORMAT_TEXT => false,
    ExportMenu::FORMAT_PDF => false,
    ExportMenu::FORMAT_EXCEL => [
        'label' => Yii::t('app', 'Excel 95 +'),
        'icon' => $isFa ? 'file-excel-o' : 'floppy-remove',
        'iconOptions' => ['class' => 'text-success'],
        'linkOptions' => [],
        'options' => ['title' => Yii::t('app', 'Microsoft Excel 95+ (xls)')],
        'alertMsg' => Yii::t('app', 'The EXCEL 95+ (xls) export file will be generated for download.'),
        'mime' => 'application/vnd.ms-excel',
        'extension' => 'xls',
        //'writer' => 'Excel5'
    ],
    ExportMenu::FORMAT_EXCEL_X => [
        'label' => Yii::t('app', 'Excel 2007+'),
        'icon' => $isFa ? 'file-excel-o' : 'floppy-remove',
        'iconOptions' => ['class' => 'text-success'],
        'linkOptions' => [],
        'options' => ['title' => Yii::t('app', 'Microsoft Excel 2007+ (xlsx)')],
        'alertMsg' => Yii::t('app', 'The EXCEL 2007+ (xlsx) export file will be generated for download.'),
        'mime' => 'application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'extension' => 'xlsx',
        //'writer' => 'Excel2007'
    ],
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{update}',
        'buttons' => [
            'update' => function ($url, $model, $key) {
                return $url;
            },
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            /* @var $model \common\models\search\VwCustomerOrdersSearch */
            $url = '#';
            $class = 'btn btn-sm ';

            if ($action === 'update') {
                switch ($model->ORDER_STATUS) {
                    case OrderHelper::STATUS_ORDER_CANCELLED:
                        $action = '<i class="fa fa-pencil fa-1x"></i><br/>View';
                        $class .= 'btn-success';
                        $url = \yii\helpers\Url::toRoute(['customer-orders/view', 'id' => $model->ORDER_ID]);
                        break;
                    case OrderHelper::STATUS_ORDER_PENDING:
                    case OrderHelper::STATUS_PAYMENT_PENDING:
                        $action = '<i class="fa fa-pencil fa-1x"></i><br/>Confirm';
                        $class .= 'btn-success';
                        $url = \yii\helpers\Url::toRoute(['customer-orders/confirm-order', 'id' => $model->ORDER_ID]);
                        break;
                    case OrderHelper::STATUS_PAYMENT_CONFIRMED:
                    case OrderHelper::STATUS_ORDER_CONFIRMED:
                        $action = '<i class="fa fa-cutlery fa-1x"></i><br/>Assign Kitchen';
                        $class .= 'btn-warning';
                        $url = \yii\helpers\Url::toRoute(['customer-orders/assign-kitchen', 'id' => $model->ORDER_ID]);
                        break;
                    case OrderHelper::STATUS_KITCHEN_ASSIGNED:
                        $action = '<i class="fa fa-building fa-1x"></i><br/>View';
                        $class .= 'btn-success';
                        $url = \yii\helpers\Url::toRoute(['customer-orders/view', 'id' => $model->ORDER_ID]);
                        break;
                    case OrderHelper::STATUS_CHEF_ASSIGNED:
                    case OrderHelper::STATUS_UNDER_PREPARATION:
                        $action = '<i class="fa fa-hourglass-2 fa-1x"></i><br/>View';
                        $class .= 'btn-success';
                        $url = \yii\helpers\Url::toRoute(['customer-orders/view', 'id' => $model->ORDER_ID]);
                        break;
                        break;
                    case OrderHelper::STATUS_ORDER_READY:
                        $action = '<i class="fa fa-hourglass fa-1x"></i><br/>View';
                        $class .= 'btn-success';
                        $url = \yii\helpers\Url::toRoute(['customer-orders/view', 'id' => $model->ORDER_ID]);
                        break;
                    case OrderHelper::STATUS_AWAITING_RIDER:
                    case OrderHelper::STATUS_RIDER_ASSIGNED:
                    case OrderHelper::STATUS_RIDER_DISPATCHED:
                    case OrderHelper::STATUS_ORDER_DELIVERED:
                        $action = '<i class="fa fa-pencil fa-1x"></i><br/>View';
                        $class .= 'btn-success';
                        $url = \yii\helpers\Url::toRoute(['view', 'id' => $model->ORDER_ID]);
                        break;
                    default:
                        $action = '<i class="fa fa-cog fa-1x"></i><br/>View';
                        $class .= 'btn-success';
                        $url = \yii\helpers\Url::toRoute(['view', 'id' => $model->ORDER_ID]);
                        break;
                }

            }

            return Html::a($action, $url, ['class' => $class]);
        },
    ],
    'ORDER_ID',
    'SURNAME',
    'OTHER_NAMES',
    'MOBILE',
    //'PAYMENT_NUMBER',
    //'PAYMENT_AMOUNT',
    [
        'header' => 'Delivery Location',
        'attribute' => 'LOCATION_ID',
        'format' => 'raw',
        'value' => function ($model) {
            /* @var $model \common\models\CustomerOrder */
            $address = "{$model->lOCATION->LOCATION_NAME} {$model->lOCATION->cITY->CITY_NAME}";
            return ucwords(strtolower($address));
        }
    ],
    [
        'header' => 'Chef',
        'filter' => false,
        'attribute' => 'CHEF_ID',
        'value' => function ($model) {
            /* @var $model \common\models\CustomerOrder */
            return $model->cHEF != null ? $model->cHEF->CHEF_NAME : 'N/A';
        }
    ],
    [
        'header' => 'Rider',
        'filter' => false,
        'attribute' => 'RIDER_ID',
        'value' => function ($model) {
            /* @var $model \common\models\CustomerOrder */
            return $model->rIDER != null ? $model->rIDER->uSER->SURNAME : 'N/A';
        }
    ],
    [


        'filter' => true,
        //'format' => 'datetime',
        'attribute' => 'ORDER_DATE',
        //'visible'=>false,
        'value' => function ($model) {
            /* @var $model \common\models\CustomerOrder */
            return APP_UTILS::FormatDateTime($model->ORDER_DATE);// \app\model_extended\CUSTOMER_ORDER_ITEMS::GetOrderTotal($model->ORDER_ID);
        }
    ],
    [
        'filter' => false,
        'attribute' => 'ORDER_TIME',
        //'visible'=>false,
        'value' => function ($model) {
            /* @var $model \common\models\CustomerOrder */
            $validDate = APP_UTILS::isValidDate($model->ORDER_TIME);


            return APP_UTILS::FormatDateTime($model->ORDER_TIME, !$validDate);
        }
    ],
    //'ORDER_DATE',
    //'PAYMENT_METHOD',
    'ORDER_STATUS',
    //'NOTES'
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{print}',

        'buttons' => [
            'print' => function ($url, $model, $key) {
                return $url;
            },
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            $url = '#';
            $class = 'btn btn-xs ';
            if ($action === 'print') {
                switch ($model->ORDER_STATUS) {
                    //case OrderHelper::STATUS_PAYMENT_PENDING:
                    case OrderHelper::STATUS_PAYMENT_CONFIRMED:
                    case OrderHelper::STATUS_ORDER_CONFIRMED:
                    case OrderHelper::STATUS_KITCHEN_ASSIGNED:
                    case OrderHelper::STATUS_CHEF_ASSIGNED:
                    case OrderHelper::STATUS_UNDER_PREPARATION:
                    case OrderHelper::STATUS_ORDER_READY:
                    case OrderHelper::STATUS_AWAITING_RIDER:
                    case OrderHelper::STATUS_RIDER_ASSIGNED:
                    case OrderHelper::STATUS_RIDER_DISPATCHED:
                    case OrderHelper::STATUS_ORDER_DELIVERED:
                        $action = 'Receipt';
                        $class .= 'btn-primary';
                        $url = \yii\helpers\Url::toRoute(['customer-orders/print', 'id' => $model->ORDER_ID]);
                        break;
                    default:
                        $class .= 'btn-primary hidden';
                        break;
                }

            }
            return Html::a($action, $url, ['class' => $class, 'target' => '_blank']);
        }
    ]
];

?>



<?= ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'columnSelectorOptions' => [
        'label' => 'Columns',
        'class' => 'btn btn-danger'
    ],
    'filename' => strtolower($this->title),
    'fontAwesome' => $isFa,
    'dropdownOptions' => [
        'label' => 'Export All',
        'class' => 'btn btn-primary'
    ],
    'exportConfig' => $exportConfig,
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => $this->title, 'options' => ['colspan' => 4, 'class' => 'text-center success']],
            ],
            'options' => ['class' => 'skip-export'] // remove this row from export
        ]
    ],
    'summary' => "Showing <strong>{begin}-{end}</strong> of <strong>{totalCount}</strong> Orders",
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => false,
    'showPageSummary' => false,
    'panel' => false,
    'resizableColumns' => true,
    'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
    'pjax' => false,
    'pjaxSettings' => [
        'neverTimeout' => true,
        //'beforeGrid' => 'My fancy content before.',
        //'afterGrid' => 'My fancy content after.',
    ]
]); ?>
