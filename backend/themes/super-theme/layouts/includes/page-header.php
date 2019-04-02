<?php
/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 3/30/2019
 * Time: 11:44 PM
 */
/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

?>
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title"><?= Html::encode($this->title) ?></h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <?=
                    Breadcrumbs::widget([

                        'homeLink' => [
                            'label' => '<i class="mdi mdi-home-outline"></i>' . Html::encode(Yii::t('yii', 'Home')),
                            'url' => Yii::$app->homeUrl
                        ],
                        'encodeLabels' => false,
                        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n", // template for all links,
                        'activeItemTemplate' => "<li class='breadcrumb-item active' aria-current='page'>{link}</li>",
                        'tag' => 'ol',
                        'options' => [
                            'class' => 'breadcrumb'
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]); ?>
                    <!--<ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                        <li class="breadcrumb-item active" aria-current="page">Blank page</li>
                    </ol>-->
                </nav>
            </div>
        </div>
        <div class="right-title">
            <div class="dropdown">
                <button class="btn btn-outline dropdown-toggle no-caret" type="button" data-toggle="dropdown"><i
                            class="mdi mdi-dots-horizontal"></i></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="mdi mdi-share"></i>Activity</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-email"></i>Messages</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-help-circle-outline"></i>FAQ</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-settings"></i>Support</a>
                    <div class="dropdown-divider"></div>
                    <button type="button" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
