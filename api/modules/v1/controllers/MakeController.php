<?php


namespace api\modules\v1\controllers;


use common\controllers\BaseRestController;
use common\models\Makes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/*
 * @inheritDoc
 */

class MakeController extends BaseRestController
{
    public $modelClass = 'common\models\Makes';


    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['view']);
        return $actions;
    }

    /**
     * @SWG\Get(path="/makes",
     *     tags={"Makes"},
     *     summary="Retrieves the collection of Vehicle makes",
     *     produces={"application/json"},
     *     consumes={"application/x-www-form-urlencoded"},
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Makes")
     *     ),
     *	@SWG\Response(response = 401, description = "Authorization required")
     * )
     */
    public function actionIndex()
    {
        $activeData = new ActiveDataProvider([
            'query' => Makes::find(),
            //'pagination' => false
        ]);
        return $activeData;
    }

    /**
     * @SWG\Get(
     *     path="/makes/find-by-make/{make}",
     *     tags={"Makes"},
     *     description="Return a specific make",
     *     @SWG\Parameter(
     *         name="make",
     *         in="path",
     *         type="string",
     *         description="Vehicle make",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(response=422, description="No make of that type found"),
     *     @SWG\Response(response = 401, description = "Authorization required")
     * )
     * @param $make
     * @return ActiveDataProvider
     */
    public function actionFindByMake($make)
    {
        $activeData = new ActiveDataProvider([
            'query' => Makes::findByBySlug($make),
            'pagination' => false
        ]);
        return $activeData;
    }

    /**
     * @SWG\Post(
     *    path = "/makes",
     *    tags = {"Makes"},
     *    operationId = "addMake",
     *    summary = "Add new vehicle make",
     *    description = "Add new vehicle make",
     *    produces = {"application/json"},
     *    consumes = {"application/json"},
     *	@SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "Make data",
     *        required = true,
     *        type = "string",
     *      @SWG\Schema(ref = "#/definitions/Makes")
     *    ),
     *	@SWG\Response(response = 200, description = "success"),
     *	@SWG\Response(response = 401, description = "Authorization required")
     *)
     */
    public function actionCreate()
    {
        return [];
    }

    /**
     * @SWG\Post(
     *    path = "/makes/{make}",
     *    tags = {"Makes"},
     *    operationId = "updateMake",
     *    summary = "update vehicle make",
     *    description = "Add new vehicle make",
     *    produces = {"application/json"},
     *    consumes = {"application/json"},
     *	@SWG\Parameter(
     *        in = "path",
     *        name = "make",
     *        description = "Make id",
     *        required = true,
     *        type = "string",
     *    ),
     *	@SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "Make data",
     *        required = true,
     *        type = "string",
     *      @SWG\Schema(ref = "#/definitions/Makes")
     *    ),
     *	@SWG\Response(response = 200, description = "success"),
     *	@SWG\Response(response = 401, description = "Authorization required")
     *)
     */
    public function actionUpdate($make)
    {
        $message = [];
        if (!Yii::$app->request->isPut) {
            throw new BadRequestHttpException('Please use PUT');
        }

        /* @var $request Makes */
        $request = (object)Yii::$app->request->post();

        $model = $this->findModel($make);
        $model->name = $request->name;
        if ($model->validate() && $model->save()) {
            return $model;
        } else {
            $errors = $model->getErrors();
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
     * Finds the Makes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $slug
     * @return Makes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Makes::findOne(['name' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}