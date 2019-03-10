<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use common\widgets\Alert;

\frontend\assetsmanager\SlimAsset::register($this);

$formatter = \Yii::$app->formatter;
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

        <div class="row row-xs">
            <!-- cart and menu content here -->
            <div class="col-lg-9 col-md-12 col-sm-12">
                <!-- start: page -->
                <?= $content ?>
                <!-- end: page -->
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <section class="panel panel-success">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                            <!--<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>-->
                        </div>
                        <?php $title = isset($this->params['title']) ? $this->params['title'] : ''; ?>
                        <h2 class="panel-title"><?= $title ?></h2>
                    </header>
                    <div class="panel-body">
                        <table data-height="auto" class="table table-condensed table-border">
                            <tbody>
                            <?php
                            /* @var $orderItems \app\model_extended\CART_MODEL */
                            $cart_items = isset($this->params['cart_items']) ? $this->params['cart_items'] : [];
                            $orderSubTotal = 0.0;

                            foreach ($cart_items as $key => $orderItems):
                                $itemTotal = (int)$orderItems->QUANTITY * (float)$orderItems->ITEM_PRICE;
                                $orderSubTotal = $orderSubTotal + (int)$orderItems->QUANTITY * (float)$orderItems->ITEM_PRICE;
                                ?>
                                <tr>
                                    <td align="right">
                                        <?= Editable::widget([
                                            'model' => $orderItems,
                                            'attribute' => 'QUANTITY',
                                            'asPopover' => false,
                                            'submitOnEnter' => true,
                                            'editableValueOptions' => ['class' => 'text-danger'],
                                            'formOptions' => [
                                                'action' => ['change-quantity', 'id' => $orderItems->CART_ITEM_ID]
                                            ], 'options' => [
                                                'id' => "qty_$orderItems->CART_ITEM_ID",
                                                'format' => Editable::FORMAT_LINK,
                                                'inputType' => Editable::INPUT_SPIN,
                                            ]
                                        ]) ?>x
                                    </td>
                                    <td><?= "{$orderItems->iTEMTYPE->mENUITEM->MENU_ITEM_NAME} ({$orderItems->iTEMTYPE->ITEM_TYPE_SIZE})"; ?></td>
                                    <td class="text-right"><?= $formatter->asCurrency($itemTotal) ?></td>
                                </tr>
                            <?php
                            endforeach;
                            $vat = 0;
                            $deliveryFee = 0;
                            $orderTotal = ($vat + $deliveryFee + $orderSubTotal);
                            ?>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line text-right"><strong>Order Sub Total</strong></td>
                                <td class="thick-line text-right">
                                    <strong><?= $formatter->asCurrency($orderSubTotal) ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line text-right"><strong>Including V.A.T</strong></td>
                                <td class="thick-line text-right">
                                    <strong><?= $formatter->asCurrency($vat) ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line text-right"><strong>Delivery Fee</strong></td>
                                <td class="thick-line text-right">
                                    <strong><?= $formatter->asCurrency($deliveryFee) ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line text-right"><strong>Order Total</strong></td>
                                <td class="thick-line text-right">
                                    <strong><?= $formatter->asCurrency($orderTotal) ?></strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">

                        <?= Html::a(count($cart_items) > 0 ? 'PROCEED TO CHECKOUT' : 'CART IS EMPTY',
                            count($cart_items) > 0 ? ['//customer/default/checkout'] : '#',
                            ['class' => count($cart_items) > 0 ? 'btn btn-success btn-lg btn-block' : 'btn btn-danger btn-lg btn-block']) ?>
                    </div>
                </section>
            </div>
            <!-- end cart and menu content here -->
        </div>

    </div><!-- container -->
</div><!-- slim-mainpanel -->

<?php require_once('includes/footer.php') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
