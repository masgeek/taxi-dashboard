<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'USER_ID',
            'USER_NAME',
            'USER_TYPE',
            'SURNAME',
            'OTHER_NAMES',
            // 'MOBILE',
            // 'EMAIL:email',
            // 'LOCATION_ID',
            // 'PASSWORD',
            // 'DATE_REGISTERED',
            // 'LAST_UPDATED',
            // 'CLIENT_TOKEN',
            // 'RESET_TOKEN',
            // 'USER_STATUS:boolean',
            // 'TOKEN_EXPPIRY',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
