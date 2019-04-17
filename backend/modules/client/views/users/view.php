<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Users' . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">

            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'username',
            'password',
            [
                'attribute' => 'userType.user_type',
                'label' => 'User Type',
            ],
            'account_active',
            'email:email',
            'allowance',
            'allowance_updated_at',
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerAccessTokens->totalCount) {
            $gridColumnAccessTokens = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'token',
                'auth_code',
                'app_id',
                'expires_at',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerAccessTokens,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tb-access-tokens']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Access Tokens'),
                ],
                'columns' => $gridColumnAccessTokens
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerAuthorizationCodes->totalCount) {
            $gridColumnAuthorizationCodes = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'code',
                'app_id',
                'expires_at',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerAuthorizationCodes,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tb-authorization-codes']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Authorization Codes'),
                ],
                'columns' => $gridColumnAuthorizationCodes
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerUserClient->totalCount) {
            $gridColumnUserClient = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'client.id',
                    'label' => 'Client'
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerUserClient,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tb-user-client']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('User Client'),
                ],
                'columns' => $gridColumnUserClient
            ]);
        }
        ?>
    </div>
</div>