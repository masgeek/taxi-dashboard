<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MenuItem as MENU_ITEMS;

/* @var $this yii\web\View */
/* @var $model \common\models\MenuItemType */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="menu-item-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MENU_ITEM_ID')->dropDownList(MENU_ITEMS::GetMenuItems(null)) ?>

    <?= $form->field($model, 'ITEM_TYPE_SIZE')->dropDownList(MENU_ITEMS::GetItemSizes()) ?>

    <?= $form->field($model, 'PRICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AVAILABLE')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
