<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\login\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="signin-box">
    <h2 class="signin-title-primary">Welcome back!</h2>
    <h3 class="signin-title-secondary">Sign in to continue.</h3>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'username')->textInput([
        'placeholder' => 'Enter your username'
    ])->label(false) ?>


    <?= $form->field($model, 'password')->passwordInput([
        'placeholder' => 'Enter your password'
    ])->label(false) ?>


    <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block btn-signin', 'name' => 'login-button']) ?>
    <?php ActiveForm::end(); ?>
    <p class="mg-b-0">Don't have an account?
        <?= Html::a('Sign Up', ['site/signup'], ['title' => 'Sign up to be able to view results']) ?>
    </p>
</div>
