<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'AccessTokens',
        'relID' => 'access-tokens',
        'value' => \yii\helpers\Json::encode($model->accessTokens),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'AuthorizationCodes',
        'relID' => 'authorization-codes',
        'value' => \yii\helpers\Json::encode($model->authorizationCodes),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserClient',
        'relID' => 'user-client',
        'value' => \yii\helpers\Json::encode($model->userClients),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Password']) ?>

    <?= $form->field($model, 'user_type')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserType::find()->orderBy('user_type')->asArray()->all(), 'user_type', 'user_type'),
        'options' => ['placeholder' => 'Choose Tb user type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'account_active')->checkbox() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'allowance')->textInput(['placeholder' => 'Allowance']) ?>

    <?= $form->field($model, 'allowance_updated_at')->textInput(['placeholder' => 'Allowance Updated At']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('AccessTokens'),
            'content' => $this->render('_formAccessTokens', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->accessTokens),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('AuthorizationCodes'),
            'content' => $this->render('_formAuthorizationCodes', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->authorizationCodes),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('UserClient'),
            'content' => $this->render('_formUserClient', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->userClients),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
