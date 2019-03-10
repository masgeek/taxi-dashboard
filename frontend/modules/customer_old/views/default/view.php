<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Our Menu';
$this->params['breadcrumbs'][] = $this->title;

$listviewWidget = ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'id' => 'menu_list',
    ],
    'layout' => "{items}",
    'itemView' => 'menu_box']);

?>


<?= $listviewWidget ?>
