<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 14-Aug-18
 * Time: 2:44 PM
 *
 * @var \yii\data\ActiveDataProvider $listDataProvider
 */

use yii\widgets\ListView;
use yii\helpers\Url;
use yii\helpers\Html;

$listviewWidget = ListView::widget([
    'dataProvider' => $listDataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'row',
    ],
    'layout' => "{items}",
    //'layout' => "{pager}\n{items}\n{summary}",
    //'itemView' => '_product_view_old',
    'itemView' => 'sub-views/_account-type-box']);


?>
<div class="row row-xs">
    <?php
    foreach ($listDataProvider->models as $key => $model) {
        echo $this->render('sub-views/_account-type-box', ['model' => $model]);
    }
    ?>
</div>


<p class="mg-t-40 mg-b-0">Already have an account?
    <?= Html::a('Sign In', ['site/login'], ['title' => 'Sign in to view our results']) ?>
</p>