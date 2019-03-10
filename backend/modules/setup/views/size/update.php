<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sizes */

$this->title = 'Update Sizes: ' . ' ' . $model->SIZE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Sizes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SIZE_ID, 'url' => ['view', 'id' => $model->SIZE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sizes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
