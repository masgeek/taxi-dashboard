<?php

use kartik\detail\DetailView;
use common\models\CustomerOrderItem;

/* @var $this yii\web\View */
/* @var $model \common\models\CustomerOrder */
/* @var $tracker \common\models\OrderTracking */
/* @var $form yii\widgets\ActiveForm */

$attributes = [
    [
        'group' => true,
        'label' => 'Order Details',
        'rowOptions' => ['class' => 'success']
    ],
    [
        'columns' => [
            [
                'attribute' => 'ORDER_ID',
//'label'=>'Book #',
                'displayOnly' => true,
                'valueColOptions' => ['style' => 'width:30%']
            ],
            [
                'label' => 'Order Amount',
                'attribute' => 'ORDER_ID',
                'displayOnly' => true,
                'value' => CustomerOrderItem::GetOrderTotal($model->ORDER_ID),
                'format' => 'currency',
                'inputContainer' => ['class' => 'col-sm-6'],
            ],

        ],
    ],
    [
        'columns' => [
            [
                'label' => 'Delivery Address',
                'attribute' => 'ADDRESS_ID',
                'format' => 'raw',
                'displayOnly' => true,
                'value' => "<address>{$model->lOCATION->LOCATION_NAME} <br/> {$model->lOCATION->cITY->CITY_NAME}</address>",
            ],
            [
                'attribute' => 'ORDER_STATUS',
                'format' => 'raw',
                'displayOnly' => true,
                'value' => "<span class='badge' style='background-color: {$model->oRDERSTATUS->COLOR};'> </span>  <code>" . $model->ORDER_STATUS . '</code>',
                //'type' => DetailView::INPUT_COLOR,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],
    [
        'columns' => [
            ['label' => 'Quantity',
                'attribute' => 'ORDER_ID',
                'value' => CustomerOrderItem::GetOrderQuantity($model->ORDER_ID),
                'displayOnly' => true,
            ],
            [
                'attribute' => 'ORDER_DATE',
                'displayOnly' => true,
                //'format' => 'datetime',
                'value' => \common\helper\APP_UTILS::FormatDateTime($model->ORDER_DATE),
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],
    [
        'columns' => [
            [
                'label' => 'Assigned Rider',
                'attribute' => 'RIDER_ID',
                'displayOnly' => true,
                'value' => $model->rIDER != null ? $model->rIDER->uSER->SURNAME : 'Not Assigned',
            ],
            [
                'label' => 'Assigned Chef',
                'attribute' => 'CHEF_ID',
                'displayOnly' => true,
                'value' => $model->cHEF != null ? $model->cHEF->CHEF_NAME : 'Not Assigned',
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],
    [
        'columns' => [
            [
                'label' => 'Assigned Kitchen',
                'attribute' => 'KITCHEN_ID',
                'displayOnly' => true,
                'value' => $model->kITCHEN != null ? $model->kITCHEN->KITCHEN_NAME : 'Not Assigned',
            ],
        ],
    ],
    [
        'columns' => [
            [
                'attribute' => 'PAYMENT_METHOD',
                'displayOnly' => true,
            ],
            [
                'attribute' => 'NOTES',
                'displayOnly' => true,
                'valueColOptions' => ['style' => 'width:30%'],
            ],
        ],
    ],

];
?>

<?= DetailView::widget([
    'model' => $model,
    'mode' => DetailView::MODE_VIEW,
    'condensed' => true,
    'bordered' => true,
    'hover' => false,
    'panel' =>false,
    'attributes' => $attributes,
]) ?>