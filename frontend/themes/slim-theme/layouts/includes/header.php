<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>
<div class="slim-header">
    <div class="container">
        <div class="slim-header-left">
            <h2 class="slim-logo"><a href="index.html"><?= Yii::$app->name ?><span>.</span></a></h2>
        </div><!-- slim-header-left -->
        <div class="slim-header-right">
            <!-- dropdown -->
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="dropdown dropdown-c">
                    <a href="#" class="logged-user" data-toggle="dropdown">
                        <img src="http://via.placeholder.com/500x500" alt="">
                        <span></span><?= Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <nav class="nav hide-sidebar">
                            <a href="page-profile.html" class="nav-link"><i class="icon ion-person"></i> View
                                Profile</a>
                            <a href="page-edit-profile.html" class="nav-link"><i class="icon ion-compose"></i> Edit
                                Profile</a>
                            <a href="page-activity.html" class="nav-link"><i class="icon ion-ios-bolt"></i> Activity Log</a>
                            <a href="page-settings.html" class="nav-link"><i class="icon ion-ios-gear"></i> Account
                                Settings</a>
                            <a href="page-signin.html" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
                        </nav>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
            <?php endif; ?>
        </div><!-- header-right -->
    </div><!-- container -->
</div><!-- slim-header -->

