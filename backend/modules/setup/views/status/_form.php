<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\ColorInput;

/* @var $this yii\web\View */
/* @var $model \common\models\Status */
/* @var $form yii\widgets\ActiveForm */

$scopeArr = [
    'INACTIVE' => 'DEACTIVATE',
    'OFFICE' => 'OFFICE',
    'ALL' => 'All LEVELS',
    'RIDER' => 'RIDER',
    'KITCHEN' => 'KITCHEN',
];

asort($scopeArr);
?>

<div class="status--model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STATUS_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS_DESC')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'COLOR')->textInput(['maxlength' => true]) ?-->

    <?= $form->field($model, 'COLOR')->widget(ColorInput::classname(), [
        'useNative' => true,
        'options' => [
            'placeholder' => '---SELECT COLOR---'
        ],
    ]); ?>
    <!--?= $form->field($model, 'SCOPE')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'SCOPE')->dropDownList($scopeArr) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'RANK')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'WORKFLOW')->textInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
