<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CustomersOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ORDER_ID',
            'USER_ID',
            'LOCATION_ID',
            'KITCHEN_ID',
            'CHEF_ID',
            // 'RIDER_ID',
            // 'ORDER_DATE',
            // 'PAYMENT_METHOD',
            // 'ORDER_STATUS',
            // 'ORDER_TIME',
            // 'NOTES',
            // 'CREATED_AT',
            // 'UPDATED_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
