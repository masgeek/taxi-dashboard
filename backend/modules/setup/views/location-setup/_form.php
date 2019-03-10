<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CITY_ID', ['template' => $field_template])->dropDownList(\common\models\City::GetCity(), ['prompt' => 'Select City']) ?>

    <?= $form->field($model, 'LOCATION_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDRESS')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ACTIVE')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
