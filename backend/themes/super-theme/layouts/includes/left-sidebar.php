<?php
/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 3/30/2019
 * Time: 11:43 PM
 */

//$home = \yii\helpers\Url::toRoute(['//site']);
use yii\helpers\Html;

?>
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="user-profile treeview">
                <a href="<?= Yii::$app->homeUrl ?>">
                    <img src="../myassets/images/avatar/8.jpg" alt="user">
                    <span>
                        <span class="d-block font-weight-600 font-size-16"><?= Yii::$app->user->identity ?></span>
                        <br/>
                        <span class="email-id">samuel@gmail.com</span>
                    </span>
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="javascript:void()"><i class="fa fa-user mr-5"></i>My Profile </a></li>
                    <li><a href="javascript:void()"><i class="fa fa-money mr-5"></i>My Balance</a></li>
                    <li><a href="javascript:void()"><i class="fa fa-envelope-open mr-5"></i>Inbox</a></li>
                    <li><a href="javascript:void()"><i class="fa fa-cog mr-5"></i>Account Setting</a></li>
                    <li><a href="javascript:void()"><i class="fa fa-power-off mr-5"></i>Logout</a></li>
                </ul>
            </li>
            <li class="header nav-small-cap"><i class="mdi mdi-drag-horizontal mr-5"></i><?= Yii::$app->name ?></li>

            <li>
                <?= Html::a('<i class="mdi mdi-view-dashboard"></i><span>Dashboard</span>', [
                    '//site/dashboard'
                ], [
                    'class' => 'sidebar-link',
                ]) ?>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-car"></i>
                    <span>Cars</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?= Html::a('<i class="mdi mdi-toggle-switch-off"></i>Manage Cars', [
                            '//cars/manage'
                        ], [
                            'class' => 'sidebar-link',
                        ]) ?>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-account"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?= Html::a('<i class="mdi mdi-toggle-switch-off"></i>Manage Users', [
                            '//cars/manage'
                        ], [
                            'class' => 'sidebar-link',
                        ]) ?>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-ungroup"></i>
                    <span>Invoice</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?= Html::a('<i class="mdi mdi-toggle-switch-off"></i>Invoice List', [
                            '//invoice/list'
                        ], [
                            'class' => 'sidebar-link',
                        ]) ?>
                    </li>
                    <li>
                        <?= Html::a('<i class="mdi mdi-toggle-switch-off"></i>Invoice', [
                            '//invoice/single-invoice'
                        ], [
                            'class' => 'sidebar-link',
                        ]) ?>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
