<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'capacity')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'color')->textInput() ?>

    <?= $form->field($model, 'mileage')->textInput() ?>

    <?= $form->field($model, 'total_distance')->textInput() ?>

    <?= $form->field($model, 'reg_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_year')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
