<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'client_type')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ClientTypes::find()->orderBy('client_type')->asArray()->all(), 'client_type', 'client_type'),
                'options' => ['placeholder' => 'Choose Tb client types'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'landline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'base_charge')->textInput() ?>

    <?= $form->field($model, 'min_charge')->textInput() ?>

    <?= $form->field($model, 'waiting_charge')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
