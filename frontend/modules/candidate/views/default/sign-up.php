<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Please fill out the following fields to Register:</p>

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'error-block'
    ]);
    ?>
    <!--?php $form = ActiveForm::begin(['id' => 'form-signup']); ?-->

    <?= $form->errorSummary($model) ?>


    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'exam_type')->widget(Select2::class, [
                'data' => \common\models\ExamType::GetExamTypes(),
                'options' => ['placeholder' => 'Select exam type'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'exam_ref') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'exam_year')->widget(Select2::class, [
                'data' => \common\helper\TimelineHelper::getYearRange(3),
                'options' => ['placeholder' => 'Select exam year'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'password')->widget(\kartik\password\PasswordInput::class, [
                'pluginOptions' => [
                    'showMeter' => true,
                    'toggleMask' => false
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'confirm_password')->passwordInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::class, [
                //'widgetOptions' => ['class' => 'col-sm-offset-3']
            ])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton('Sign Up', ['class' => 'btn btn-outline-primary btn-block btn-lg', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

