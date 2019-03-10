<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\CustomerOrder */
/* @var $scope array */
/* @var $workflow int */

$this->params['breadcrumbs'][] = ['label' => 'Customer  Orders', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->ORDER_ID, 'url' => ['view', 'id' => $model->ORDER_ID]];
$this->params['breadcrumbs'][] = 'Update';


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
<div class="customer-orders-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('Orders', ['//customer-orders-vw'], ['class' => 'btn btn-success btn-block']) ?>
    <hr/>
    <?=
    TabsX::widget([
        'items' => $items,
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'bordered' => true,
    ]);
    ?>

    <?=
    $this->render('partial-views/_form', [
        'model' => $model,
        'scope' => $scope,
        'workflow' => $workflow])
    ?>
</div>
