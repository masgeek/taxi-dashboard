<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\KitchenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kitchen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'KITCHEN_ID') ?>

    <?= $form->field($model, 'KITCHEN_NAME') ?>

    <?= $form->field($model, 'CITY_ID') ?>

    <?= $form->field($model, 'OPENING_TIME') ?>

    <?= $form->field($model, 'CLOSING_TIME') ?>

    <?php // echo $form->field($model, 'ADDRESS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
