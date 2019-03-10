<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Chef */

$this->title = 'Update Chef: ' . ' ' . $model->CHEF_ID;
$this->params['breadcrumbs'][] = ['label' => 'Chefs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CHEF_ID, 'url' => ['view', 'id' => $model->CHEF_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chef-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
