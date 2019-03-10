<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\frontend\assetsmanager\SlimAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<?php require_once('includes/meta-head.php') ?>

<body class="slim-sticky-header">
<?php $this->beginBody() ?>

<?php require_once('includes/header.php') ?>
<?php if (!Yii::$app->user->isGuest) : ?>
    <?php require_once('includes/nav-bar.php') ?>
<?php endif; ?>
<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <?=
            Breadcrumbs::widget([
                'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n", // template for all links,
                'activeItemTemplate' => "<li class='breadcrumb-item active' aria-current='page'>{link}</li>",
                'tag' => 'ol',
                'options' => [
                    'class' => 'breadcrumb'
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]); ?>

            <h6 class="slim-pagetitle"><?= \yii\helpers\Html::encode($this->title) ?></h6>
        </div><!-- slim-pageheader -->

        <?= $content ?>
    </div><!-- container -->
</div><!-- slim-mainpanel -->

<?php require_once('includes/footer.php') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
