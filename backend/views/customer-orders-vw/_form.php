<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VwOrders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ORDER_ID')->textInput() ?>

    <?= $form->field($model, 'USER_ID')->textInput() ?>

    <?= $form->field($model, 'KITCHEN_ID')->textInput() ?>

    <?= $form->field($model, 'CHEF_ID')->textInput() ?>

    <?= $form->field($model, 'RIDER_ID')->textInput() ?>

    <?= $form->field($model, 'MOBILE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SURNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OTHER_NAMES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ORDER_DATE')->textInput() ?>

    <?= $form->field($model, 'ORDER_STATUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAYMENT_AMOUNT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAYMENT_NUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOTES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAYMENT_METHOD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATED_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATED_AT')->textInput() ?>

    <?= $form->field($model, 'PAYMENT_DATE')->textInput() ?>

    <?= $form->field($model, 'LOCATION_ID')->textInput() ?>

    <?= $form->field($model, 'LOCATION_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDRESS')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'CITY_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CITY_ID')->textInput() ?>

    <?= $form->field($model, 'COUNRY_ID')->textInput() ?>

    <?= $form->field($model, 'COUNTRY_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ORDER_TIME')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
