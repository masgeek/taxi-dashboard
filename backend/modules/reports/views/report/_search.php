<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

use common\models\VwSalesReports as ReportModel;
use common\models\Location as LOCATION_MODEL;
use common\models\Riders as RIDER_MODEL;
use common\models\Chef as CHEF_MODEL;
use common\models\Kitchen as KITCHEN_MODEL;

/* @var $this yii\web\View */
/* @var $model \common\models\search\ReportSearch */
/* @var $context */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="report-model-search">

    <?php $form = ActiveForm::begin([
        //'action' => ['index'],
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

    <?php if ($context === ReportModel::CONTEXT_GENERAL): ?>

    <?php elseif ($context === ReportModel::CONTEXT_ORDERS): ?>
        <?= $form->field($model, 'ORDER_STATUS')->dropDownList(ReportModel::getOrderStatuses(), [
                'prompt' => '--- ALL STATUS ---',
                'class' => 'form-control'
            ]
        ) ?>
    <?php elseif ($context === ReportModel::CONTEXT_SALES): ?>

    <?php elseif ($context === ReportModel::CONTEXT_LOCATION): ?>
        <?= $form->field($model, 'LOCATION_ID')->dropDownList(LOCATION_MODEL::GetAllLocations(), [
                'prompt' => '--- ALL LOCATIONS ---',
                'class' => 'form-control'
            ]
        ) ?>
    <?php elseif ($context === ReportModel::CONTEXT_RIDER): ?>
        <?= $form->field($model, 'RIDER_ID')->dropDownList(RIDER_MODEL::GetAllRiders(), [
                'prompt' => '--- ALL RIDERS ---',
                'class' => 'form-control'
            ]
        ) ?>
    <?php elseif ($context === ReportModel::CONTEXT_CHEF): ?>
        <?= $form->field($model, 'CHEF_ID')->dropDownList(CHEF_MODEL::GetAllChefs(), [
                'prompt' => '--- ALL CHEFS ---',
                'class' => 'form-control',
            ]
        ) ?>
    <?php elseif ($context == ReportModel::CONTEXT_KITCHEN): ?>
        <?= $form->field($model, 'KITCHEN_ID')->dropDownList(KITCHEN_MODEL::GetKitchens(), [
                'prompt' => '--- ALL KITCHENS ---',
                'class' => 'form-control',
            ]
        ) ?>
    <?php endif; ?>


    <div class="form-group">

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn-block hidden']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
