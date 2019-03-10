<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 14-Aug-18
 * Time: 3:11 PM
 */
/* @var $model \common\models\AccountType */
?>



<div class="card card-pricing-three">
    <div class="card-header <?= $model->class ?>"><?= $model->account_type ?></div>
    <div class="card-pricing">
        <h1><i class="fa fa-user fa-2x"></i></h1>
    </div><!-- card-pricing -->
    <div class="card-body">
        <p><?= $model->description ?></p>
        <?= \yii\helpers\Html::a('Sign Up', ["{$model->module_name}/register"], ['class' => 'btn btn-outline-primary btn-block']) ?>
    </div><!-- card-body -->
</div><!-- card -->
