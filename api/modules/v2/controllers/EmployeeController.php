<?php


namespace api\modules\v2\controllers;


use api\models\Employee;
use common\controllers\BaseRestController;
use yii\filters\AccessControl;
use Yii;
use yii\rest\ActiveController;


class EmployeeController extends BaseRestController
{
    public $modelClass = 'api\models\Employee';

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['create']);
        return $actions;
    }


    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $params = $this->request['search'];
        $response = Employee::search($params);
        return Yii::$app->api->sendSuccessResponse($response['data'], $response['info']);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Employee;
        $model->attributes = $this->request;

        if ($model->save()) {
            return Yii::$app->api->sendSuccessResponse($model->attributes);
        }

        return Yii::$app->api->sendFailedResponse($model->errors);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $model->attributes = $this->request;

        if ($model->save()) {
            return Yii::$app->api->sendSuccessResponse($model->attributes);
        }
        return Yii::$app->api->sendFailedResponse($model->errors);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return Yii::$app->api->sendSuccessResponse($model->attributes);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return Yii::$app->api->sendSuccessResponse($model->attributes);
    }

    /**
     * @param $id
     * @return Employee|null
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }
        return Yii::$app->api->sendFailedResponse("Invalid Record requested");
    }
}