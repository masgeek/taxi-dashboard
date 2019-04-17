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
use ethercreative\ratelimiter\RateLimiter;
use Yii;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Base Controller API
 *
 * This controller implements the basic authentication and will be extended by all rest controllers for ease of use
 *
 * @author Sammy Barasa <barsamms@gmail.com>
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="127.0.0.1:8002",
 *     basePath="/api/v1",
 *      produces={"application/json"},
 *     consumes={"application/x-www-form-urlencoded","application/json"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Taxi service API",
 *         description="Api endpoints for taxi service",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="sammy@tsobu.co.ke"
 *         ),
 *         @SWG\License(
 *             name="Private License",
 *             url="URL to the license"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="Find out more about my website",
 *         url="https/swagger.io"
 *     )
 * )
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

        $behaviors['rateLimiter'] = [
            // Use class
            'class' => RateLimiter::class,
            //'class' => \yii\filters\RateLimiter::class,
            //'user' => Users::class,
            // The maximum number of allowed requests per specified timepreiod
            'rateLimit' => 200,
            // The time period for the rates to apply to in seconds
            'timePeriod' => 60,
            // Separate rate limiting for guests and authenticated users
            // Defaults to true
            // - false: use one set of rates, whether you are authenticated or not
            // - true: use separate ratesfor guests and authenticated users
            'separateRates' => true,
            // Whether to return HTTP headers containing the current rate limiting information
            'enableRateLimitHeaders' => true,
        ];

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
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
            'class' => VerbFilter::class,
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
            'exclude' => ['index', 'create', 'update', 'view'],
            'callback' => []
        ];

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        $behaviors['requestcheck'] = [
            'class' => Requestcheck::class,
            'requestbody' => $this->request
        ];

        /*$behaviors['authenticator'] = [
             'class' => CompositeAuth::class,
             'authMethods' => [
                 HttpBasicAuth::class,
                 HttpBearerAuth::class,
                 QueryParamAuth::class,
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
        if (!$this->request && !is_array($this->request)) {
            return Yii::$app->api->sendFailedResponse(['Invalid Json']);
        }
        return true;
    }
}