<?php

namespace api\modules\v2\controllers;


use common\models\login\LoginForm;
use Yii;
use common\models\AuthorizationCodes;
use common\models\AccessTokens;
use common\controllers\BaseRestController;
use api\behaviours\Apiauth;
use frontend\models\SignupForm;


/**
 * Site controller
 */
class SiteController extends BaseRestController
{
    public $modelClass = 'common\models\login\User';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['apiauth'] = [
            'class' => Apiauth::class,
            'exclude' => ['authorize', 'register', 'access-token', 'index', 'me'],
        ];

        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::class,
            'actions' => [
                'register' => ['POST'],
                'authorize' => ['POST'],
                'access-token' => ['POST'],
                'view' => ['GET'],
                'create' => ['GET', 'POST'],
                'update' => ['GET', 'PUT', 'POST'],
                'delete' => ['POST', 'DELETE'],
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return Yii::$app->api->sendSuccessResponse(['Yii2 RESTful API with OAuth2']);
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        $model->attributes = $this->request;
        if ($user = $model->signup()) {

            $data = $user->attributes;
            unset($data['auth_key']);
            unset($data['password_hash']);
            unset($data['password_reset_token']);

            return Yii::$app->api->sendSuccessResponse($data);
        }

        return Yii::$app->api->sendSuccessResponse($model->getErrors());
    }

    public function actionMe()
    {
        $data = Yii::$app->user->identity;
        $data = $data->attributes;
        unset($data['auth_key']);
        unset($data['password_hash']);
        unset($data['password_reset_token']);

        return Yii::$app->api->sendSuccessResponse($data);
    }

    public function actionAccessToken()
    {

        if (!isset($this->request["authorization_code"])) {
            return Yii::$app->api->sendFailedResponse("Authorization code missing");
        }


        $authorization_code = $this->request["authorization_code"];


        $auth_code = AuthorizationCodes::isValid($authorization_code);


        if (!$auth_code) {
            return Yii::$app->api->sendFailedResponse("Invalid Authorization Code");
        }


        $accesstoken = Yii::$app->api->createAccesstoken($authorization_code);


        $data = [];
        $data['access_token'] = $accesstoken->token;
        $data['expires_at'] = $accesstoken->expires_at;

        return Yii::$app->api->sendSuccessResponse($data);

    }

    public function actionAuthorize()
    {
        $model = new LoginForm();

        $model->attributes = $this->request;


        if ($model->validate() && $model->login()) {

            $auth_code = Yii::$app->api->createAuthorizationCode(Yii::$app->user->identity['id']);
            $data = [];
            $data['authorization_code'] = $auth_code->code;
            $data['expires_at'] = $auth_code->expires_at;

            return Yii::$app->api->sendSuccessResponse($data);
        }
        return Yii::$app->api->sendFailedResponse($model->errors);
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionLogout()
    {
        $headers = Yii::$app->getRequest()->getHeaders();
        $access_token = $headers->get('x-access-token');

        if (!$access_token) {
            $access_token = Yii::$app->getRequest()->getQueryParam('access-token');
        }

        $model = AccessTokens::findOne(['token' => $access_token]);

        if ($model->delete()) {

            return Yii::$app->api->sendSuccessResponse(["Logged Out Successfully"]);

        }

        return Yii::$app->api->sendFailedResponse("Invalid Request");

    }
}
