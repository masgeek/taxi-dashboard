<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 10-Nov-17
 * Time: 11:40
 *
 * @var $model \common\models\MenuItem
 * @var $itemType \common\models\MenuItemType
 */

use yii\helpers\Html;
use yii\helpers\Url;

$imageHelper = new \common\helper\ImageHelper();


$imageFolder = \Yii::getAlias('@imagesfolder');


$fullImagePath = $imageFolder . DIRECTORY_SEPARATOR . $model->MENU_ITEM_IMAGE;

$encodes = $imageHelper->encodeImage($fullImagePath);
$image = $encodes->getDataUri();
//print_r($encodes->getDataUri());
//die;
//$image = \common\helper\APP_UTILS::BuildImageUrl($model->MENU_ITEM_IMAGE, false);
$prevCat = null;
?>

<div class="card">
    <div class="card-header"><?= $model->mENUCAT->MENU_CAT_NAME ?></div>
    <div class="card-body">
        <div class="row row-xs">
            <!--<h5 class="card-title">Primary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            <div class="col-md-2">
                <?= Html::img("$image", ['alt' => 'Pizza Out', 'class' => 'img img-thumbnail']); ?>
            </div>
            <div class="col-md-4">
                <p class="large-text"><?= $model->MENU_ITEM_NAME ?></p>
                <p class="muted"><?= $model->MENU_ITEM_DESC ?></p>
            </div>
            <div class="col-md-6">
                <table class="table  table-hover">
                    <?php foreach ($model->menuItemTypes as $key => $itemType): ?>
                        <tr>
                            <td valign="center">
                                <p class="large-text">
                                    <?= $itemType->ITEM_TYPE_SIZE ?>
                                </p>
                            </td>
                            <td class="text-center">
                                <p class="large-text">
                                    <?= $itemType->PRICE ?>
                                </p>
                            </td>
                            <td class="text-center">
                                <?= Html::a('<i class="fa fa-plus-circle"></i>',
                                    ['//customer/default/add'], [
                                        'class' => 'btn btn-default',
                                        'data-method' => 'POST',
                                        'data-params' => [
                                            'MENU_ITEM_ID' => $model->MENU_ITEM_ID,
                                            'ITEM_TYPE_ID' => $itemType->ITEM_TYPE_ID,
                                            'ITEM_TYPE_SIZE' => $itemType->ITEM_TYPE_SIZE,
                                            'ITEM_PRICE' => $itemType->PRICE,
                                            'QUANTITY' => 1,
                                        ],
                                    ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
