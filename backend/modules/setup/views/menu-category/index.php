<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MenuCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Menu Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'MENU_CAT_ID',
            'MENU_CAT_NAME',
            //'MENU_CAT_IMAGE',
            //'IMAGE:image',
            [
                'attribute' => 'IMAGE',
                'label' => 'Image',
                'format' => 'raw',
                'filter' => false,
                'value' => function ($model) {
                    /* @var $model \common\models\MenuCategory */

                    return Html::img($model->IMAGE != null ? $model->IMAGE : \common\helper\ImageHelper::defaultImage(), [
                    //return Html::img($model->IMAGE != null ? $model->IMAGE : $model->defaultImage(), [
                        'alt' => 'myImage',
                        'class' => 'img-fluid img-thumbnail',
                        'width' => '70'
                    ]);
                }
            ],
            'ACTIVE:boolean',
            'RANK',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}',
                // 'dropdown' => true
            ],
        ],
    ]); ?>

</div>
