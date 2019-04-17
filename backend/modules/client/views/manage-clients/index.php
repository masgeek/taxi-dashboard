<?php

use kartik\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    //'id',
    'name',
    'client_type',
    'email:email',
    'mobile',
    'landline',
    'base_charge:currency',
    'min_charge:currency',
    'waiting_charge:currency',
    'currency',
    //'updated_by',
    //'created_by',
    //'slug',
    'created_at:datetime',
    'updated_at:datetime',

    ['class' => 'yii\grid\ActionColumn'],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Users',
        'dropdown' => false,
        'template' => '{add_members}',
        'buttons' => [
            'add_members' => function ($url, $model, $key) {
                /* @var $model \common\models\Clients */
                //Let us find the number of members under this committee
                $users = 0;


                $linkTitle = "Users&nbsp;<span class='badge badge-danger'>{$users}</span>";
                $actionUrl = [
                    'committee-member/create'
                ];

                return Html::a($linkTitle, ['manage-client-users', 'slug' => $model->slug]);
                return Html::a($linkTitle, $actionUrl, [
                    'data' => ['method' => 'post'],
                    'data-params' => [
                        'slug' => $model->slug,
                    ],
                    'class' => 'btn btn-outline-success btn-xs',
                    'title' => 'Add client users'
                ]);
            },
        ]
    ]
];
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Clients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]); ?>

</div>
