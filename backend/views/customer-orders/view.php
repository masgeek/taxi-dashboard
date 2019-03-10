<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model \common\models\CustomerOrder */

$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['customer-orders-vw/index']];
$this->params['breadcrumbs'][] = $this->title;


$items = [
    [
        'label' => '<i class="glyphicon glyphicon-home"></i> Order Details',
        'content' => $this->render('/customer-orders-vw/partial-views/_order_details', ['model' => $model,]),
        'active' => true
    ],
    [
        'label' => '<i class="glyphicon glyphicon-apple"></i> Order Items',
        'content' => $this->render('/customer-orders-vw/partial-views/_order_items', ['model' => $model]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-credit-card"></i> Payment Details',
        'content' => $this->render('/customer-orders-vw/partial-views/_payment_info', ['model' => $model]),
    ],
];

?>
<div class="customer--orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Process Order Here', ['//customer-orders-vw'], ['class' => 'btn btn-outline-primary']) ?>
    </p>

    <?=
    TabsX::widget([
        'items' => $items,
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'bordered' => true,
    ]);
    ?>
</div>
