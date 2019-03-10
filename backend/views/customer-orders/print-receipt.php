<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use yii2assets\printthis\PrintThis;

/* @var $this yii\web\View */
/* @var $model \common\models\CustomerOrder */

$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['customer-orders-vw/index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="customer--orders-view">

    <?= PrintThis::widget([
        'htmlOptions' => [
            'id' => 'PrintThis',
            'btnClass' => 'btn btn-info',
            'btnId' => 'btnPrintThis',
            'btnText' => 'Print Receipt',
            'btnIcon' => 'fa fa-print'
        ],
        'options' => [
            'debug' => false,
            'importCSS' => true,
            'importStyle' => false,
            'loadCSS' => "path/to/my.css",
            'pageTitle' => "",
            'removeInline' => false,
            'printDelay' => 333,
            'header' => null,
            'formValues' => true,
        ]
    ]) ?>
    <hr/>
    <div id="PrintThis">
        <h1><?= Html::encode($this->title) ?></h1>
        <h5><?= date('d-M-Y H:i:s') ?></h5>
        <?= $this->render('/receipt/a4-receipt', ['model' => $model,]) ?>
        <?= $this->render('/customer-orders-vw/partial-views/_order_items', ['model' => $model]) ?>

        <p>
            Thank you for your business, we value your feedback.</p>
        <p>
            Our Call Center Number is: <strong>2040</strong>
        </p>
    </div>
</div>
