<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VwOrders */

$this->title = 'Create Vw Orders';
$this->params['breadcrumbs'][] = ['label' => 'Vw Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
