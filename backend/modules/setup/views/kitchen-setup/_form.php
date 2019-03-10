<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kitchen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kitchen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'KITCHEN_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CITY_ID')->textInput() ?>

    <?= $form->field($model, 'OPENING_TIME')->textInput() ?>

    <?= $form->field($model, 'CLOSING_TIME')->textInput() ?>

    <?= $form->field($model, 'ADDRESS')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
