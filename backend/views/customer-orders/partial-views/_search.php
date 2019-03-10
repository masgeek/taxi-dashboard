<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\CustomersOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ORDER_ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'LOCATION_ID') ?>

    <?= $form->field($model, 'KITCHEN_ID') ?>

    <?= $form->field($model, 'CHEF_ID') ?>

    <?php // echo $form->field($model, 'RIDER_ID') ?>

    <?php // echo $form->field($model, 'ORDER_DATE') ?>

    <?php // echo $form->field($model, 'PAYMENT_METHOD') ?>

    <?php // echo $form->field($model, 'ORDER_STATUS') ?>

    <?php // echo $form->field($model, 'ORDER_TIME') ?>

    <?php // echo $form->field($model, 'NOTES') ?>

    <?php // echo $form->field($model, 'CREATED_AT') ?>

    <?php // echo $form->field($model, 'UPDATED_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
