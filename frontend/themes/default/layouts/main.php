<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\frontend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<?php require_once('includes/meta-head.php') ?>

<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php require_once 'includes/nav.php' ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>
    </div>
</div>

<?php require_once('includes/footer.php') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
