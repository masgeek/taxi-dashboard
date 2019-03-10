<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kitchen */

$this->title = 'Update Kitchen: ' . ' ' . $model->KITCHEN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Kitchens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->KITCHEN_ID, 'url' => ['view', 'id' => $model->KITCHEN_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kitchen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
