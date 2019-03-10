<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\SignupForm */

//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to Register:</p>

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'error-block'
    ]);
    ?>
    <!--?php $form = ActiveForm::begin(['id' => 'form-signup']); ?-->

    <?= $form->errorSummary($model) ?>


    <div class="col-md-12">
        <?= $form->field($model, 'exam_type')->widget(Select2::class, [
            'data' => \common\models\ExamType::GetExamTypes(),
            'options' => ['placeholder' => 'Select exam type'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'exam_year')->widget(Select2::class, [
            'data' => \common\helper\TimelineHelper::getYearRange(4),
            'options' => ['placeholder' => 'Select exam year'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'exam_ref') ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'confirm_password')->passwordInput() ?>
    </div>

    <div class="col-md-12">
        <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary btn-primary-outline btn-block btn-lg', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

