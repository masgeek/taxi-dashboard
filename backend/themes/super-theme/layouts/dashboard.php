<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
\backend\assetmanager\SuperThemeAsset::register($this);
\backend\assetmanager\DashBoardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Taxi dashboard">
    <meta name="author" content="Sammy Barasa"/>
    <!--
    <link rel="icon" href="../images/favicon.ico">
    -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!--<body class="hold-transition skin-purple sidebar-mini">-->
<body class="hold-transition skin-red sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <?php require_once 'includes/header-items/header-logo.php' ?>
        <!-- Header Navbar -->
        <?php require_once 'includes/header-items/navbar.php' ?>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <?php require_once 'includes/left-sidebar.php' ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php require_once 'includes/page-header.php' ?>
        <!-- Main content -->
        <section class="content">
            <?= $content ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require_once 'includes/footer.php' ?>
</div>
<?php $this->endBody() ?>

<script type="application/javascript">
    $.widget.bridge('uibutton', $.ui.button);
</script>
</body>
</html>
<?php $this->endPage() ?>
