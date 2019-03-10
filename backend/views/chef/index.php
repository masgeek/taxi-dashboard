<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ChefSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chefs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chef-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Chef', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CHEF_ID',
            'CHEF_NAME',
            'KITCHEN_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
