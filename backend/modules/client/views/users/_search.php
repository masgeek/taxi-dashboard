<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Password']) ?>

    <?= $form->field($model, 'user_type')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserType::find()->orderBy('user_type')->asArray()->all(), 'user_type', 'user_type'),
        'options' => ['placeholder' => 'Choose Tb user type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'account_active')->checkbox() ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php /* echo $form->field($model, 'allowance')->textInput(['placeholder' => 'Allowance']) */ ?>

    <?php /* echo $form->field($model, 'allowance_updated_at')->textInput(['placeholder' => 'Allowance Updated At']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
