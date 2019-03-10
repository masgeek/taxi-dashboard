<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\CustomerOrder */
/* @var $tracker \common\models\OrderTracking */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="customer-orders-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'ORDER_STATUS')->dropDownList(\common\models\Status::GetStatus([\common\helper\APP_UTILS::KITCHEN_SCOPE]), [
                    'prompt' => '--- SELECT STATUS ---',
                ]
            ) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'CHEF_ID')->dropDownList(\common\models\Chef::GetChefs($model->KITCHEN_ID), [
                    'prompt' => '--- SELECT CHEF ---',
                ]
            ) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('ADD TO QUEUE', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
