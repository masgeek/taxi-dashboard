<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerOrder */

$this->title = 'Update Customer Order: ' . ' ' . $model->ORDER_ID;
$this->params['breadcrumbs'][] = ['label' => 'Customer Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ORDER_ID, 'url' => ['view', 'id' => $model->ORDER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
