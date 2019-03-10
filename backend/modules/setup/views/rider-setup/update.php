<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Riders */
/* @var $userModel \common\models\Users */

$this->title = Yii::t('app', 'Update Rider', [
    'nameAttribute' => $model->uSER->USER_NAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Riders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RIDER_ID, 'url' => ['view', 'id' => $model->RIDER_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Rider');
?>
<div class="rider--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_add-rider', [
        'model' => $model,
        'userModel' => $userModel,
    ]) ?>

</div>
