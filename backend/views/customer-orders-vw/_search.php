<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\VwCustomerOrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ORDER_ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'KITCHEN_ID') ?>

    <?= $form->field($model, 'CHEF_ID') ?>

    <?= $form->field($model, 'RIDER_ID') ?>

    <?php // echo $form->field($model, 'MOBILE') ?>

    <?php // echo $form->field($model, 'SURNAME') ?>

    <?php // echo $form->field($model, 'OTHER_NAMES') ?>

    <?php // echo $form->field($model, 'ORDER_DATE') ?>

    <?php // echo $form->field($model, 'ORDER_STATUS') ?>

    <?php // echo $form->field($model, 'PAYMENT_AMOUNT') ?>

    <?php // echo $form->field($model, 'PAYMENT_NUMBER') ?>

    <?php // echo $form->field($model, 'NOTES') ?>

    <?php // echo $form->field($model, 'PAYMENT_METHOD') ?>

    <?php // echo $form->field($model, 'CREATED_AT') ?>

    <?php // echo $form->field($model, 'UPDATED_AT') ?>

    <?php // echo $form->field($model, 'PAYMENT_DATE') ?>

    <?php // echo $form->field($model, 'LOCATION_ID') ?>

    <?php // echo $form->field($model, 'LOCATION_NAME') ?>

    <?php // echo $form->field($model, 'ADDRESS') ?>

    <?php // echo $form->field($model, 'CITY_NAME') ?>

    <?php // echo $form->field($model, 'CITY_ID') ?>

    <?php // echo $form->field($model, 'COUNRY_ID') ?>

    <?php // echo $form->field($model, 'COUNTRY_NAME') ?>

    <?php // echo $form->field($model, 'ORDER_TIME') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
