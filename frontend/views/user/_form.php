<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USER_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'USER_TYPE')->textInput() ?>

    <?= $form->field($model, 'SURNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OTHER_NAMES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MOBILE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LOCATION_ID')->textInput() ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_REGISTERED')->textInput() ?>

    <?= $form->field($model, 'LAST_UPDATED')->textInput() ?>

    <?= $form->field($model, 'CLIENT_TOKEN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RESET_TOKEN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'USER_STATUS')->checkbox() ?>

    <?= $form->field($model, 'TOKEN_EXPPIRY')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
