<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\Json;

use common\models\AuthorizationCodes;
use common\models\AccessTokens;

/**
 * Class for common API functions
 */
class Api extends Component
{

    public function sendFailedResponse($message, $errorCode = 400)
    {
        $this->setHeader($errorCode);
        return ['status' => 0, 'errorCode' => $errorCode, 'errors' => $message];
    }

    /**
     * @param bool $data
     * @param bool $additional_info
     * @return array|string
     */
    public function sendSuccessResponse($data = false, $additional_info = false)
    {

        $this->setHeader(200);

        $response = [];
        $response['status'] = 1;

        if (is_array($data)) {
            $response['data'] = $data;
        }

        if ($additional_info) {
            $response = array_merge($response, $additional_info);
        }

        //$response = Json::encode($response, JSON_PRETTY_PRINT);


        if (isset($_GET['callback'])) {
            /* this is required for angularjs1.0 client factory API calls to work */
            $response = $_GET['callback'] . "(" . $response . ")";
        }

        return $response;
    }

    protected function setHeader($status)
    {

        $text = $this->_getStatusCodeMessage($status);

        Yii::$app->response->setStatusCode($status, $text);

        $status_header = 'HTTP/1.1 ' . $status . ' ' . $text;
        $content_type = "application/json; charset=utf-8";


        header($status_header);
        header('Content-type: ' . $content_type);
        header('X-Powered-By: ' . "Tsobu Enterprise <support@tsobu.co.ke>");
        header('Access-Control-Allow-Origin:*');
    }

    protected function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            420 => 'Validation Errors',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    public function createAuthorizationCode($user_id)
    {
        $model = new AuthorizationCodes;

        $model->code = md5(uniqid());

        $model->expires_at = time() + (60 * 5);

        $model->user_id = $user_id;

        $model->app_id = 'PIZZAOUT';
        $model->created_at = time();
        $model->updated_at = time();

        $model->save(false);

        return $model;

    }

    /**
     * @param $authorization_code
     * @return AccessTokens
     */
    public function createAccesstoken($authorization_code)
    {

        $auth_code = AuthorizationCodes::findOne(['code' => $authorization_code]);

        $model = new AccessTokens();

        $model->token = md5(uniqid());

        $model->auth_code = $auth_code->code;

        $model->expires_at = time() + (60 * 60 * 24 * 60); // 60 days

        $model->user_id = $auth_code->user_id;

        $model->app_id = 'PIZZAOUT';

        $model->created_at = time();

        $model->updated_at = time();

        $model->save(false);

        return $model;

    }

    /**
     * @param $token
     * @return AccessTokens
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function refreshAccesstoken($token)
    {
        $access_token = AccessTokens::findOne(['token' => $token]);
        if ($access_token) {

            $access_token->delete();
            $new_access_token = $this->createAccesstoken($access_token->auth_code);
            return ($new_access_token);
        }

        return Yii::$app->api->sendFailedResponse("Invalid Access token2");
    }

}
