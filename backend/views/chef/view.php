<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Chef */

$this->title = $model->CHEF_ID;
$this->params['breadcrumbs'][] = ['label' => 'Chefs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chef-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CHEF_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CHEF_ID], [
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
            'CHEF_ID',
            'CHEF_NAME',
            'KITCHEN_ID',
        ],
    ]) ?>

</div>
