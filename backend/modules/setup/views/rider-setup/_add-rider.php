<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\UserType as USER_TYPE_MODEL;
use common\models\Kitchen as KITCHEN_MODEL;
/* @var $this yii\web\View */
/* @var $model \common\models\Riders */
/* @var $userModel \common\models\Users */
/* @var $form yii\widgets\ActiveForm */

$field_template = <<<TEMPLATE
<label>{label}</label>
<div class="input-group input-group-icon">
     {input} 
    <span class="input-group-addon">
        <span class="icon icon-lg"><i class="fa fa-cog"></i></span>
    </span>
</div>
    {error}{hint}
TEMPLATE;
?>

<div class="rider-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userModel, 'USER_NAME', ['template' => $field_template])->textInput([
                'autofocus' => true, 'class' => 'form-control input-lg'
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($userModel, 'USER_TYPE', ['template' => $field_template])->dropDownList(USER_TYPE_MODEL::GetUserTypes(['ADMIN', 'CUSTOMER']), [
                'prompt' => Yii::t('app', 'Select Account Type'), 'autofocus' => true, 'class' => 'form-control input-lg'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userModel, 'SURNAME', ['template' => $field_template])->textInput([
                'autofocus' => true, 'class' => 'form-control input-lg'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($userModel, 'OTHER_NAMES', ['template' => $field_template])->textInput([
                'autofocus' => true, 'class' => 'form-control input-lg'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userModel, 'MOBILE', ['template' => $field_template])->textInput([
                'autofocus' => true, 'class' => 'form-control input-lg'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($userModel, 'EMAIL', ['template' => $field_template])->textInput([
                'autofocus' => true, 'class' => 'form-control input-lg'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'KITCHEN_ID', ['template' => $field_template])->dropDownList(KITCHEN_MODEL::GetKitchens(), [
                'prompt' => Yii::t('app', 'Select Kitchen'),
                'class' => 'form-control input-lg'
            ]) ?>
        </div>
    </div>
    <?php if ($userModel->isNewRecord) : ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($userModel, 'PASSWORD', ['template' => $field_template])->passwordInput([
                    'autofocus' => true, 'class' => 'form-control input-lg'
                ]) ?>
            </div>
        </div>
    <?php endif; ?>
    <?= $form->field($model, 'RIDER_STATUS')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($userModel->isNewRecord ? Yii::t('app', 'Create Rider') : Yii::t('app', 'Update Rider'), ['class' => 'btn btn-success btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

