<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\common\components\FontAssets::register($this);
\frontend\assetsmanager\SlimAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<?php require_once('includes/meta-head.php') ?>

<body class="slim-sticky-header">
<?php $this->beginBody() ?>
<?php require_once('includes/header.php') ?>
<?php require_once('includes/nav-bar.php') ?>

<div class="slim-mainpanel">
    <div class="container">
        <?= $content ?>
    </div><!-- container -->
</div><!-- slim-mainpanel -->

<?php require_once('includes/footer.php') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
