<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VwOrders */

$this->title = 'Update Vw Orders: ' . ' ' . $model->ORDER_ID;
$this->params['breadcrumbs'][] = ['label' => 'Vw Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ORDER_ID, 'url' => ['view', 'id' => $model->ORDER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vw-orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
