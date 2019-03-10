<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\VwOrders */

$this->title = $model->ORDER_ID;
$this->params['breadcrumbs'][] = ['label' => 'Vw Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ORDER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ORDER_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ORDER_ID',
            'USER_ID',
            'KITCHEN_ID',
            'CHEF_ID',
            'RIDER_ID',
            'MOBILE',
            'SURNAME',
            'OTHER_NAMES',
            'ORDER_DATE',
            'ORDER_STATUS',
            'PAYMENT_AMOUNT',
            'PAYMENT_NUMBER',
            'NOTES',
            'PAYMENT_METHOD',
            'CREATED_AT',
            'UPDATED_AT',
            'PAYMENT_DATE',
            'LOCATION_ID',
            'LOCATION_NAME',
            'ADDRESS:ntext',
            'CITY_NAME',
            'CITY_ID',
            'COUNRY_ID',
            'COUNTRY_NAME',
            'ORDER_TIME',
        ],
    ]) ?>

</div>
