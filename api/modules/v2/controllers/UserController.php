<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace api\modules\v2\controllers;

use api\behaviours\Apiauth;
use api\models\USER_MODEL;
use common\controllers\BaseRestController;
use common\helper\APP_UTILS;
use common\models\ApiToken as API_TOKEN_MODEL;
use Yii;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class UserController extends BaseRestController
{
    /**
     * @var object
     */
    public $modelClass = 'api\models\USER_MODEL';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['apiauth'] = [
            'class' => Apiauth::class,
            'exclude' => ['login', 'index'],
        ];

        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete']);
        return $actions;
    }


    /**
     * @return array|null|static
     * @throws BadRequestHttpException
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionLogin()
    {
        /* @var $request USER_MODEL */
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }
        $request = (object)Yii::$app->request->post();

        $username = $request->USER_NAME;
        $password = sha1($request->PASSWORD);

        $user = USER_MODEL::findOne(['USER_NAME' => $username, 'PASSWORD' => $password]);
        if ($user == null) {//search based on email address
            $user = USER_MODEL::findOne(['EMAIL' => $username, 'PASSWORD' => $password]);
        }

        //return [];
        if ($user != null) {
            $user->status = true;
            $message = $user;
            //create the api token too
            API_TOKEN_MODEL::CreateApiToken($user->USER_ID);
        } else {
            $message = [
                'status' => false,
                'message' => 'Invalid Username/Password'
            ];
        }

        return $message;
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     * @throws \yii\base\Exception
     */
    public function actionRecover()
    {
        /* @var $request USER_MODEL */
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }
        $username = Yii::$app->request->post('USER_NAME');

        $user = USER_MODEL::find()
            ->where(['USER_NAME' => $username])
            ->orWhere(['EMAIL' => $username])
            ->one();//findOne(['USER_NAME' => $username]);


        $emailsent = APP_UTILS::SendRecoveryEmail($user);

        return [
            'RESET_SENT' => $emailsent ? true : false,
            'MESSAGE' => $emailsent ? 'A Password reset link has been sent to your registered  email' : 'No matching username found, please check and try again'
        ];
    }

    /**
     * @return USER_MODEL|array
     * @throws BadRequestHttpException
     */
    public function actionRegister()
    {
        /* @var $request USER_MODEL */
        $message = [];

        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }
        $request = ['USER_MODEL' => Yii::$app->request->post()];

        $plain_pass = Yii::$app->request->post('PASSWORD');
        $returnModel = Yii::$app->request->post('RETURN_MODEL', false);
        $userStatus = Yii::$app->request->post('USER_STATUS', false);


        $user = new USER_MODEL();
        $user->setScenario(USER_MODEL::SCENARIO_CREATE);
        $user->load($request);
        $user->RESET_TOKEN = '1234';
        $user->USER_STATUS = (boolean)$userStatus;
        if ($user->validate()) {
            $user->PASSWORD = sha1($plain_pass);
            if ($user->save()) {
                if ($returnModel === 'YES') {
                    return $user;
                }

                $message = [$user];
            }
        } else {
            $errors = $user->getErrors();
            foreach ($errors as $key => $error) {
                $message[] = [
                    'field' => $key,
                    'message' => $error[0]
                ];
            }
        }
        return $message;
    }

    /**
     * @param $id
     * @return array|null|static
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdates($id)
    {
        /* @var $request USER_MODEL */
        $message = [];

        if (!Yii::$app->request->isPut) {
            throw new BadRequestHttpException('Please use PUT');
        }

        $user = USER_MODEL::findOne($id);
        if ($user == null) {
            throw new NotFoundHttpException('User not found', 5);
        }


        $user->setScenario(USER_MODEL::SCENARIO_UPDATE);
        $request = (object)YII::$APP->REQUEST->BODYPARAMS;
        $user->SURNAME = ISSET($request->SURNAME) ? $request->SURNAME : $user->SURNAME;
        $user->EMAIL = ISSET($request->EMAIL) ? $request->EMAIL : $user->EMAIL;
        $user->MOBILE = ISSET($request->MOBILE) ? $request->MOBILE : $user->MOBILE;
        $user->OTHER_NAMES = ISSET($request->OTHER_NAMES) ? $request->OTHER_NAMES : $user->OTHER_NAMES;
        if (isset($request->CHANGE_PASSWORD)) {
            $user->PASSWORD = sha1($request->PASSWORD);
        }

        if ($user->validate() && $user->save()) {
            $message = $user;
        } else {
            $errors = $user->getErrors();
            foreach ($errors as $key => $error) {
                $message[] = [
                    'field' => $key,
                    'message' => $error[0]
                ];
            }
        }

        return $message;
    }

    /**
     * @return array
     */
    public function actionAccountType()
    {
        return [
            'CUSTOMER', 'RIDER'
        ];
    }
}