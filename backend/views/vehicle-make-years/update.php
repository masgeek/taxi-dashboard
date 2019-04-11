<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MakeYears */

$this->title = 'Update Make Years: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Make Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="make-years-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
