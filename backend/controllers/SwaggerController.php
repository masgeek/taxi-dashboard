<?php

namespace backend\controllers;


use Yii;
use yii\helpers\Url;
use yii\web\Controller;


/**
 * SwaggerController .
 */
class SwaggerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'index' => [
                'class' => 'yii2mod\swagger\SwaggerUIRenderer',
                'view' => '@vendor/masgeek/yii2-swagger/views/index',
                'restUrl' => Url::to(['swagger/json-schema'], true),
            ],
            'json-schema' => [
                'class' => 'yii2mod\swagger\OpenAPIRenderer',
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                    Yii::getAlias('@common/controllers'),
                    Yii::getAlias('@api/modules/v1/controllers'),
                    Yii::getAlias('@api/models'),
                ],
            ],

            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
