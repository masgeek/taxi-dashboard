<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 09-Aug-18
 * Time: 2:03 PM
 */

namespace common\controllers;


use common\helper\UrlHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use yii\web\Controller;

class BaseWebController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'recover', 'signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function sendJsonApiRequest($apiEndpoint, array $data, array $headers = [], $method = 'POST')
    {
        $url = UrlHelper::getBaseUrl();
        $baseUrl = "{$url}api/v1/";

        $client = new Client([
            'baseUrl' => $baseUrl,
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);


        $response = $client->createRequest()
            ->addHeaders($headers)
            ->setMethod($method)
            ->setUrl($apiEndpoint)
            ->setData($data)
            ->send();

        return $response;
    }
}