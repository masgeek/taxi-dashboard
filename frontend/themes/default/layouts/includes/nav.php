<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => [
        'class' => 'navbar-nav nav navbar-right',
        'id' => 'navbar-id',
        'style' => 'font-size: 14px;',
        'data-tag' => 'yii2-menu',
    ],

    'items' => [
        'submenuTemplate' => "\n<ul class='dropdown-menu' role='menu'>\n{items}\n</ul>\n",
        //['label' => 'Committee', 'url' => ['/committee']],
        ['label' => 'My Payments', 'url' => ['//payment']],
        ['label' => 'My Committee', 'url' => ['//committee-member']],
        ['label' => 'My Payments Sitting', 'url' => ['//committee-member-sitting']],
        Yii::$app->user->isGuest ? (
        ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ],
]);
NavBar::end();
?>