<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use limion\jqueryfileupload\JQueryFileUpload;

/* @var $this yii\web\View */
/* @var $model common\models\MenuCategory */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="menu--category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($model, 'MENU_CAT_NAME')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'MENU_CAT_IMAGE')->hiddenInput(['id' => 'filename', 'maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'IMAGE')->hiddenInput(['id' => 'encodedImage', 'maxlength' => true])->label(false) ?>

        <?= JQueryFileUpload::widget([
            'model' => $model,
            'attribute' => 'IMAGE_FILE',
            'url' => ['/setup/upload/index', 'rank' => 'category'], // your route for saving images,
            'appearance' => 'ui', // available values: 'ui','plus' or 'basic'
            'formId' => $form->id,
            'options' => [
                'multiple' => false,
                'accept' => 'image/*'
            ],
            'clientOptions' => [
                'multiple' => false,
                'maxFileSize' => 2000000,
                'dataType' => 'json',
                'acceptFileTypes' => new yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
                'autoUpload' => true
            ], 'clientEvents' => [
                'done' => "function (e, data) {
                $.each(data.result.files, function (index, file) {
                   $('#filename').val(file.name);
                   $('#encodedImage').val(file.encodedImage);
                   $('#image-preview').attr('src',file.encodedImage);
                });
            }"
            ]
        ]); ?>

    </div>
    <div class="row">
        <?= Html::img($model->IMAGE, [
            'alt' => $model->MENU_CAT_NAME,
            'id' => 'image-preview',
            'class' => 'img-thumbnail',
            'width' => 150
        ]); ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ACTIVE')->dropDownList([1 => 'Active', 0 => 'Inactive']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'RANK')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

