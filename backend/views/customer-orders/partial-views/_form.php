<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

use common\models\Kitchen;
use common\models\Status;
use  \common\models\Riders;
use common\helper\APP_UTILS;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerOrder */
/* @var $form yii\widgets\ActiveForm */

$checkboxTemplate = '<div class="checkbox i-checks">{input}{error}{hint}</div>';
?>


<div class="customer-orders-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php if ($model->KITCHEN_ID == null || $model->CHEF_ID == null): ?>
        <div class="col-md-12">
            <?= $form->field($model, 'KITCHEN_ID')->dropDownList(Kitchen::GetKitchens(), [
                    'prompt' => '--- SELECT KITCHEN ---',
                    'class' => 'form-control',
                    'id' => 'kitchen'
                ]
            ) ?>
        </div>
        <div class="col-md-12">
            <?=
            $form->field($model, 'CHEF_ID')->widget(DepDrop::classname(), [
                'options' => ['id' => 'chef-id'],
                'pluginOptions' => [
                    'depends' => ['kitchen'],
                    'placeholder' => '--- SELECT CHEF ---',
                    'url' => Url::to(['chef/chef-list'])
                ]
            ]); ?>

        </div>


    <?php endif; ?>

    <?php if ($model->scenario == APP_UTILS::SCENARIO_ASSIGN_RIDER || $model->scenario == APP_UTILS::SCENARIO_PREPARE_ORDER): ?>
        <div class="col-md-12">
            <?=
            $form->field($model, 'RIDER_ID')->widget(DepDrop::classname(), [
                'options' => [
                    'id' => 'rider',
                ],
                'data' => Riders::GetRiders($model->KITCHEN_ID),
                'pluginOptions' => [
                    'depends' => ['kitchen'],
                    'initialize' => true,
                    'placeholder' => '--- SELECT RIDER ---',
                    'url' => Url::to(['rider/get-rider'])
                ]
            ]); ?>
        </div>
    <?php endif; ?>

    <div class="col-md-12">
        <?= $form->field($model, 'ORDER_STATUS')->dropDownList(Status::GetStatus($model->ORDER_ID, $scope, $workflow), [
            'prompt' => '--- SELECT STATUS ---',
            'class' => 'form-control',
        ]) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'ALERT_USER')->checkbox(); ?>
    </div>


    <div class="col-md-12">
        <?= $form->field($model, 'COMMENTS')->textarea([
            'cols' => 4,
            'rows' => 4,
            'placeholder' => 'Comments'
        ])->label(false) ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Process Order', ['class' => 'btn btn-success btn-lg btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
