<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kitchen */

$this->title = $model->KITCHEN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Kitchens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kitchen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->KITCHEN_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->KITCHEN_ID], [
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
            'KITCHEN_ID',
            'KITCHEN_NAME',
            'CITY_ID',
            'OPENING_TIME',
            'CLOSING_TIME',
            'ADDRESS:ntext',
        ],
    ]) ?>

</div>
