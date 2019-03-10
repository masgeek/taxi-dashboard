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
<body>
<?php $this->beginBody() ?>
<div class="d-md-flex flex-row-reverse">
    <div class="signin-right">
        <?= $content ?>
    </div><!-- signin-right -->
    <div class="signin-left">
        <div class="signin-box">
            <h2 class="slim-logo">
                <a href="index.html"><?= Yii::$app->name ?><span>.</span></a>
            </h2>
            <p>We are excited to launch our new company and product <strong><?= Yii::$app->name ?></strong>. After being
                featured in too many magazines to
                mention and having created an online stir, we know that <strong
                        class="bg-black-2"><?= Yii::$app->version ?></strong> is
                going to be big.<br/>
                We also hope to win Startup Fictional Business of the Year this year.</p>

            <p>Browse our site and see for yourself why you need <?= Yii::$app->name ?>.</p>

            <p><a href="" class="btn btn-outline-secondary pd-x-25">Learn More</a></p>

            <p class="tx-12">&copy; Copyright <?= date('Y') ?>. All Rights Reserved.</p>
        </div>
    </div><!-- signin-left -->
</div><!-- d-flex -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
