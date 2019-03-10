<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sizes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sizes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SIZE_TYPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACTIVE')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
