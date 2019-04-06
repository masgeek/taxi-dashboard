<?php


namespace api\modules\v1\controllers;


use api\behaviours\Apiauth;
use common\controllers\BaseRestController;
use common\models\Users;
use Yii;
use yii\web\BadRequestHttpException;

class UserController extends BaseRestController
{
    public $modelClass = 'common\models\Users';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['apiauth'] = [
            'class' => Apiauth::class,
            'exclude' => ['login', 'index', 'create', 'recover'],
        ];

        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create']);
        unset($actions['index']);
        unset($actions['delete']);
        return $actions;
    }

    /**
     * @return mixed
     * @throws BadRequestHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {

        $this->isJsonRequest();
        $message = [];
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }

        $model = new Users();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        //now we begin the registration
        if ($model->validate()) {
            // let us begin the registration
            // $loginForm  = new LoginForm();
            //$loginForm->
            return Yii::$app->api->sendSuccessResponse($model);
        } else {
            $errors = $model->getErrors();
            foreach ($errors as $key => $error) {
                $message[] = [
                    'field' => $key,
                    'message' => $error[0]
                ];
            }
        }

        return Yii::$app->api->sendSuccessResponse($message);
    }
}