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
        unset($actions['update']);
        unset($actions['index']);
        unset($actions['delete']);
        return $actions;
    }

    /**
     * @SWG\Post(
     *    path = "/users/sign-up",
     *    tags = {"Users"},
     *    operationId = "createUser",
     *    summary = "Register a new user",
     *    description = "Add new user",
     *    produces = {"application/json"},
     *    consumes = {"application/json"},
     *	@SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "User data",
     *        required = true,
     *        type = "string",
     *      @SWG\Schema(ref = "#/definitions/Users")
     *    ),
     *	@SWG\Response(response = 200, description = "success"),
     *	@SWG\Response(response = 401, description = "Authorization required")
     *)
     */
    public function actionCreate()
    {

        $this->isJsonRequest();
        $message = [];
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }

        $request = Yii::$app->getRequest()->getBodyParams();
        $model = new Users();
        $model->load($request, '');
        $model->user_type = strtoupper($model->user_type);
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


    /**
     * @SWG\Put(
     *    path = "/users/{userid}/update",
     *    tags = {"Users"},
     *    operationId = "updateUser",
     *    summary = "Update user",
     *    description = "Update user details",
     *    produces = {"application/json"},
     *    consumes = {"application/json"},
     *	@SWG\Parameter(
     *        in = "path",
     *        name = "userid",
     *        description = "User id",
     *        required = true,
     *        type = "string",
     *    ),
     *	@SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "User data",
     *        required = true,
     *        type = "string",
     *      @SWG\Schema(ref = "#/definitions/Users")
     *    ),
     *	@SWG\Response(response = 200, description = "success"),
     *	@SWG\Response(response = 401, description = "Authorization required")
     *)
     */
    public function actionUpdate($userid)
    {
        return [];
    }
}