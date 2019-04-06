<?php
/**
 * Created by PhpStorm.
 * User: MASGEEK
 * Date: 7/25/2018
 * Time: 1:20 AM
 */

namespace common\controllers;

use api\behaviours\Apiauth;
use api\behaviours\Requestcheck;
use Yii;
use yii\helpers\Json;
use yii\rest\ActiveController;

/**
 * Base Controller API
 *
 * This controller implements the basic authentication and will be extended by all rest controllers for ease of use
 *
 * @author Sammy Barasa <barsamms@gmail.com>
 */
class BaseRestController extends ActiveController
{
    public $request;

    public $enableCsrfValidation = false;

    public $headers;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'data',
        'linksEnvelope' => 'links',
        'metaEnvelope' => 'info'
    ];


    public function init()
    {
        $file_contents = file_get_contents('php://input');
        $this->request = Json::decode($file_contents, true);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                // 'Access-Control-Allow-Origin' => ['*', 'http://haikuwebapp.local.com:81','http://localhost:81'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => []
            ]

        ];

        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::class,
            'actions' => [
                //'index' => ['POST'],
                'index' => ['GET', 'POST'],
                'view' => ['GET'],
                'create' => ['GET', 'POST'],
                'update' => ['GET', 'PUT', 'POST'],
                'delete' => ['POST', 'DELETE'],
            ],
        ];

        $behaviors['apiauth'] = [
            'class' => Apiauth::class,
            'exclude' => ['index', 'view'],
            'callback' => []
        ];

        //$behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        $behaviors['requestcheck'] = [
            'class' => Requestcheck::class,
            'requestbody' => $this->request
        ];
        /*$behaviors['authenticator'] = [
             'class' => CompositeAuth::className(),
             'authMethods' => [
                 //HttpBasicAuth::className(),
                 //HttpBearerAuth::className(),
                 //QueryParamAuth::className(),
             ],
         ];*/

        return $behaviors;
    }

    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }

    public function isJsonRequest()
    {
        if ($this->request && !is_array($this->request)) {
            return Yii::$app->api->sendFailedResponse(['Invalid Json']);
        }
        return true;
    }
}