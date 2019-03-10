<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

use common\models\MenuCategory as MENU_CATEGORY;
use common\models\MenuItem as MENU_ITEMS;
use common\models\MenuItemType as MENU_ITEM_TYPE;

/* @var $this yii\web\View */
/* @var $model \common\models\search\ReportSearch*/
/* @var $context */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="report-model-search">

    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ORDER_DATE', [
        'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-calendar"></i>']],
        'options' => ['class' => 'drp-container form-group']
    ])->widget(\kartik\daterange\DateRangePicker::className(), [
        'useWithAddon' => true,
        'convertFormat' => true,
        'startAttribute' => 'START_DATE',
        'endAttribute' => 'END_DATE',
        'pluginOptions' => [
            //'timePicker' => true,
            //'timePickerIncrement' => 15,
            'locale' => [
                //'format' => 'Y-m-d h:i A',
                'format' => 'Y-m-d',
                'separator' => ' TO '
            ],
        ],
    ])->hint('Orders Date range period'); ?>


    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'MENU_CAT_NAME')->dropDownList(MENU_CATEGORY::GetMenuCategories(true),
                [
                    'prompt' => '--- ALL CATEGORIES ---',
                    'class' => 'form-control',
                ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'MENU_ITEM_NAME')->dropDownList(MENU_ITEMS::GetMenuItems(null, true),
                [
                    'prompt' => '--- ALL MENU ITEMS ---',
                    'class' => 'form-control',
                ]) ?>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'ITEM_TYPE_SIZE')->dropDownList(MENU_ITEM_TYPE::getMenuItems(),
                [
                    'prompt' => '--- ALL SIZES ---',
                    'class' => 'form-control',
                ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

