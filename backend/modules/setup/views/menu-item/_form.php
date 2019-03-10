<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use limion\jqueryfileupload\JQueryFileUpload;
use common\models\MenuCategory as MENU_CATEGORY;

/* @var $this yii\web\View */
/* @var $model \common\models\MenuItem */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="menu--items-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'MENU_CAT_ID')->dropDownList(MENU_CATEGORY::GetMenuCategories()) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'MENU_ITEM_NAME')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'HOT_DEAL')->checkbox() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'VEGETARIAN')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'MAX_QTY')->textInput(['type' => 'number']) ?>
        </div>
    </div>
    <div class="row">
        <?= $form->field($model, 'MENU_ITEM_DESC')->textarea(['rows' => 6]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'MENU_ITEM_IMAGE')->hiddenInput(['id' => 'filename', 'maxlength' => true])->label(false) ?>

        <?= $form->field($model, 'IMAGE')->hiddenInput(['id' => 'encodedImage', 'maxlength' => true])->label(false) ?>

        <?= JQueryFileUpload::widget([
            'model' => $model,
            'attribute' => 'IMAGE_FILE',
            'url' => ['/setup/upload/index', 'rank' => 'menuitem'], // your route for saving images,
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
            'alt' => $model->MENU_ITEM_NAME,
            'id' => 'image-preview',
            'class' => 'img-thumbnail',
            'width' => 150
        ]); ?>
    </div>

    <div class="form - group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
