<?php

namespace backend\modules\setup\controllers;

use common\controllers\BaseWebController;
use common\models\Riders;
use common\models\search\OrdersSearch;
use common\models\search\RiderSearch;
use common\models\Users;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RiderSetupController implements the CRUD actions for Riders model.
 */
class RiderSetupController extends BaseWebController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RIDER_MODEL models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = Yii::t('app', 'Riders');
        $searchModel = new RiderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRiderOrders($riderId)
    {
        $this->view->title = Yii::t('app', 'Rider Orders');
        $searchModel = new OrdersSearch();

        $dataProvider = $searchModel->searchRiderOrders(Yii::$app->request->queryParams, $riderId);

        return $this->render('_riders-orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RIDER_MODEL model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RIDER_MODEL model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Riders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RIDER_MODEL model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $this->view->title = Yii::t('app', 'Update Rider');

        $connection = \Yii::$app->db;
        $model = $this->findModel($id);
        $userModel = $model->uSER;
        if ($model->load(Yii::$app->request->post()) && $userModel->load(Yii::$app->request->post())) {
            //debug here
            //begin transactional saving
            $transaction = $connection->beginTransaction();
            $userModel->RESET_TOKEN = 'NONE';

            if ($userModel->save()) {
                $model->USER_ID = $userModel->USER_ID;
                //save the rider details on the table
                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['index']);
                }
            } else {
                $transaction->rollBack(); //roll back in case we have an error
                // $this->refresh(); //reset the submissions
            }

        }

        return $this->render('update', [
            'model' => $model,
            'userModel' => $userModel
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionAddRider()
    {
        $this->view->title = Yii::t('app', 'Add New Rider');

        $connection = \Yii::$app->db;
        $model = new Riders();
        $userModel = new Users();
        $model->RIDER_STATUS = true;

        if ($model->load(Yii::$app->request->post()) && $userModel->load(Yii::$app->request->post())) {
            //debug here
            $post = Yii::$app->request->post('USERS_MODEL');
            //begin transactional saving
            $transaction = $connection->beginTransaction();
            $password = $post['PASSWORD'];
            $userModel->PASSWORD = sha1($password);
            $userModel->RESET_TOKEN = 'NONE';

            if ($userModel->save()) {
                $model->USER_ID = $userModel->USER_ID;
                //save the rider details on the table
                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['index']);
                }
            } else {
                $transaction->rollBack(); //roll back in case we have an error
                // $this->refresh(); //reset the submissions
            }

        }

        return $this->render('add-rider', [
            'model' => $model,
            'userModel' => $userModel,
        ]);
    }


    public function actionGetRider()
    {
        /* @var $value Riders */
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $rider_id = $parents[0];


                $chefs = Riders::GetRiders($rider_id, true);

                foreach ($chefs as $key => $value) {
                    $out[] = [
                        'id' => $value->RIDER_ID,
                        'name' => "{$value->uSER->SURNAME}, {$value->uSER->OTHER_NAMES}"
                    ];
                }
                return Json::encode(['output' => $out, 'selected' => '']);
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Deletes an existing RIDER_MODEL model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        try {
            $rider = $this->findModel($id);
            $rider->delete();
            $rider->uSER->delete();
        } catch (Exception $ex) {
            return new Exception($ex->getMessage(), $ex->errorInfo, $ex->getCode());
        } catch (\Exception $ex) {
            return new Exception($ex->getMessage(), $ex->errorInfo, $ex->getCode());
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the RIDER_MODEL model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Riders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Riders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
