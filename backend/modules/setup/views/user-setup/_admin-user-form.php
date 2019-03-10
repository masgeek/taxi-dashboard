<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UserType as USER_TYPE_MODEL;

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $form yii\widgets\ActiveForm */

$field_template = <<<TEMPLATE
<label>{label}</label>
<div class="input-group input-group-icon">
     {input} 
    <span class="input-group-addon">
        <span class="icon icon-lg"><i class="fa fa-user"></i></span>
    </span>
</div>
    {error}{hint}
TEMPLATE;

?>

<div class="users-model-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?= $form->field($model, 'USER_NAME', ['template' => $field_template])->textInput(['readonly' => true]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'SURNAME', ['template' => $field_template])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'OTHER_NAMES', ['template' => $field_template])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'MOBILE', ['template' => $field_template])->textInput() ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'EMAIL', ['template' => $field_template])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'USER_TYPE', ['template' => $field_template])->dropDownList(USER_TYPE_MODEL::GetUserTypes([])) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Sign Up' : 'Update Profile', ['class' => 'btn btn-success btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
