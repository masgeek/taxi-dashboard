<?php

namespace backend\controllers;

use common\helper\OrderHelper;
use Yii;
use common\models\VwOrders;
use common\models\search\VwCustomerOrdersSearch;
use common\controllers\BaseWebController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerOrdersVwController implements the CRUD actions for VwOrders model.
 */
class CustomerOrdersVwController extends BaseWebController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all VwOrders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VwCustomerOrdersSearch();

        $pendingOrder = $searchModel->search(Yii::$app->request->queryParams, [OrderHelper::STATUS_ORDER_PENDING, OrderHelper::STATUS_PAYMENT_PENDING]);
        $confirmedOrder = $searchModel->search(Yii::$app->request->queryParams, [OrderHelper::STATUS_ORDER_CONFIRMED]);
        $preparingOrder = $searchModel->search(Yii::$app->request->queryParams, [OrderHelper::STATUS_UNDER_PREPARATION, OrderHelper::STATUS_CHEF_ASSIGNED]);

        $orderReady = $searchModel->search(Yii::$app->request->queryParams, [
            OrderHelper::STATUS_ORDER_READY]);

        $cancelledOrder = $searchModel->search(Yii::$app->request->queryParams, [OrderHelper::STATUS_ORDER_CANCELLED]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'pendingOrder' => $pendingOrder,
            'confirmedOrder' => $confirmedOrder,
            'preparingOrder' => $preparingOrder,
            'orderReady' => $orderReady,
            'cancelledOrder' => $cancelledOrder
        ]);
    }

    /**
     * Displays a single VwOrders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VwOrders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VwOrders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ORDER_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VwOrders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ORDER_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VwOrders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VwOrders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VwOrders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VwOrders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
