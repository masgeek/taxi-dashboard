<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace api\modules\v1\controllers;

use app\api\modules\v1\models\ACCOUNT_TYPE_MODEL;
use app\api\modules\v1\models\SERVICE_MODEL;
use app\models\ContactForm;
use yii\rest\ActiveController;

class RiderController extends ActiveController
{
    /**
     * @var object
     */
    public $modelClass = 'app\api\modules\v1\models\RIDER_MODEL';

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        //unset($actions['create']);
        //unset($actions['update']);
        return $actions;
    }

    /**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param \yii\base\Model $model the model to be accessed. If `null`, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     * @throws \yii\web\ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        /*$api_token = Yii::$app->request->headers->get("api_token", null);
        $user_id = Yii::$app->request->headers->get("user_id", null);

        if ($api_token == null && $user_id == null) {
            throw new \yii\web\ForbiddenHttpException("You can't $action this section. $api_token");
        }
        //check if the token is valid
        if (!API_TOKEN_MODEL::IsValidToken($api_token, $user_id)) {
            throw new \yii\web\ForbiddenHttpException('Invalid token, access denied');
        }*/
    }
}