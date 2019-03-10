<?php

namespace backend\controllers;

use common\helper\APP_UTILS;
use common\helper\OrderHelper;
use Yii;
use common\models\CustomerOrder;
use common\models\search\CustomersOrderSearch;
use common\controllers\BaseWebController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerOrdersController implements the CRUD actions for CustomerOrder model.
 */
class CustomerOrdersController extends BaseWebController
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
     * Lists all CustomerOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomersOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerOrder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CustomerOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ORDER_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CustomerOrder model.
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

    public function actionConfirmOrder($id)
    {
        $this->view->title = "Order #{$id}";
        $model = $this->findModel($id);
        $model->scenario = APP_UTILS::SCENARIO_CONFIRM_ORDER;

        $orderCancelled = false;
        if ($model->load(Yii::$app->request->post())) {
            //goto receipt printing
            if ($model->save()) {
                if ($model->ORDER_STATUS === OrderHelper::STATUS_ORDER_CANCELLED) {
                    $orderCancelled = true;
                }
                return $orderCancelled ? $this->redirect(['customer-orders-vw/index']) : $this->redirect(['customer-orders/print', 'id' => $id]);
            }
        }

        $scope = [
            APP_UTILS::OFFICE_SCOPE,
            APP_UTILS::ALL_SCOPE
        ];
        $workflow = OrderHelper::NextWorkFlow($id, $scope);

        return $this->render('confirm-order', [
            'model' => $model,
            'scope' => $scope,
            'workflow' => $workflow
        ]);
    }

    /**
     * @param $id
     * @param null $token
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPrint($id, $token = null)
    {
        if ($token != null) {
            //change layout
            $this->layout = 'register_layout';
        }
        $this->view->title = 'Order Receipt #' . $id;
        return $this->render('print-receipt', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing CustomerOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
