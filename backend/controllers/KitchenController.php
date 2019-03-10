<?php

namespace backend\controllers;

use common\helper\APP_UTILS;
use common\models\Chef;
use common\models\CustomerOrder;
use common\models\search\VwCustomerOrdersSearch;
use Yii;
use common\helper\OrderHelper as ORDER_HELPER;
use yii\web\NotFoundHttpException;


/**
 * KitchenController .
 */
class KitchenController extends \common\controllers\BaseWebController
{

    public function behaviors()
    {
        return [];
    }

    public function actionIndex()
    {
        $filterParams = [
            ORDER_HELPER::STATUS_ORDER_CONFIRMED,
            ORDER_HELPER::STATUS_KITCHEN_ASSIGNED,
            ORDER_HELPER::STATUS_CHEF_ASSIGNED,
            ORDER_HELPER::STATUS_UNDER_PREPARATION
        ];

        $this->view->title = Yii::t('app', 'Kitchen Management');
        $searchModel = new VwCustomerOrdersSearch();
        $kitchenAllocated = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, [ORDER_HELPER::STATUS_KITCHEN_ASSIGNED, ORDER_HELPER::STATUS_ORDER_CONFIRMED]);
        $chefAssigned = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, [ORDER_HELPER::STATUS_CHEF_ASSIGNED, ORDER_HELPER::STATUS_ORDER_CONFIRMED]);

        $preparingOrder = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, $filterParams);

        $orderReady = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, [ORDER_HELPER::STATUS_ORDER_READY]);
        $awaitingRider = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, [ORDER_HELPER::STATUS_AWAITING_RIDER]);
        $allocatedRider = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, [ORDER_HELPER::STATUS_RIDER_ASSIGNED]);
        $dispatchRider = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, [ORDER_HELPER::STATUS_RIDER_DISPATCHED]);

        return $this->render('/kitchen/index', [
            'searchModel' => $searchModel,
            'kitchenAllocated' => $kitchenAllocated,
            'allocatedRider' => $allocatedRider,
            'orderReady' => $orderReady,
            'chefAssigned' => $chefAssigned,
            'dispatchRider' => $dispatchRider,
            'preparingOrder' => $preparingOrder,
            'awaitingRider' => $awaitingRider,
        ]);
    }


    /**
     * Updates an existing CUSTOMER_ORDERS model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $tracker = new STATUS_TRACKING_MODEL();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tracker->ORDER_ID = $model->ORDER_ID;
            $tracker->STATUS = $model->ORDER_STATUS;
            if ($tracker->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('/kitchen/update', [
            'model' => $model,
            'tracker' => $tracker
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDisplay()
    {
        //$this->layout = 'queue_layout';

        $this->view->title = Yii::t('app', 'Kitchen Queue');
        $searchModel = new VwCustomerOrdersSearch();
        $filterParams = [
            ORDER_HELPER::STATUS_ORDER_CONFIRMED,
            ORDER_HELPER::STATUS_KITCHEN_ASSIGNED,
            ORDER_HELPER::STATUS_CHEF_ASSIGNED,
            ORDER_HELPER::STATUS_UNDER_PREPARATION
        ];

        $chefCount = Chef::GetChefCount();
        $pageSize = ['pageSize' => $chefCount];

        $kitchenAllocated = $searchModel->searchKitchenQueue(Yii::$app->request->queryParams, $filterParams, $pageSize);
        return $this->render('display', [
            'dataProvider' => $kitchenAllocated,
            'time' => date('H:i:s'),
        ]);
    }

    public function actionAssignChef($id)
    {
        $this->view->title = "Assign Chef to order #{$id}";
        $model = $this->findModel($id);

        $model->scenario = APP_UTILS::SCENARIO_ASSIGN_CHEF;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $scope = [
            APP_UTILS::KITCHEN_SCOPE,
        ];
        $workflow = ORDER_HELPER::NextWorkFlow($id, $scope);

        return $this->render('update-order', [
            'model' => $model,
            'scope' => $scope,
            'workflow' => $workflow
        ]);
    }

    public function actionPrepareOrder()
    {
        return $this->render('prepare-order');
    }

    public function actionOrderReady($id)
    {
        $this->view->title = "Order #{$id} Is Ready";
        $model = $this->findModel($id);

        $model->scenario = APP_UTILS::SCENARIO_PREPARE_ORDER;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        $scope = [
            APP_UTILS::KITCHEN_SCOPE,
        ];
        $workflow = ORDER_HELPER::NextWorkFlow($id, $scope);

        return $this->render('update-order', [
            'model' => $model,
            'scope' => $scope,
            'workflow' => $workflow
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdateRider($id)
    {
        $this->view->title = "Update Order #{$id} a rider";
        $model = $this->findModel($id);

        $model->scenario = APP_UTILS::SCENARIO_ASSIGN_RIDER;


        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        $scope = [
            APP_UTILS::KITCHEN_SCOPE,
        ];
        $workflow = ORDER_HELPER::NextWorkFlow($id, $scope);
        return $this->render('update-order', [
            'model' => $model,
            'scope' => $scope,
            'workflow' => $workflow
        ]);
    }

    /**
     * Finds the CUSTOMER_ORDERS model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CustomerOrder the loaded model
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = CustomerOrder::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
