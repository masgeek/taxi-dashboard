<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/17/2017
 * Time: 3:45 PM
 */

namespace api\modules\v2\controllers;

use api\behaviours\Apiauth;
use api\models\CUSTOMER_ORDER_MODEL;
use common\controllers\BaseRestController;
use common\helper\OrderHelper as ORDER_HELPER;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class OrderController extends BaseRestController
{
    /**
     * @var object
     */
    public $modelClass = 'api\models\CUSTOMER_ORDER_MODEL';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['apiauth'] = [
            'class' => Apiauth::class,
            'exclude' => ['my-orders','active-orders','rider-orders'],
        ];

        return $behaviors;
    }

    /**
     * @param $user_id
     * @return ActiveDataProvider
     */
    public function actionMyOrders($user_id)
    {
        $order_type_post = Yii::$app->request->post('ORDER_TYPE', 'CONFIRMED');
        $order_type = strtoupper($order_type_post);
        $data = $this->getOrders($order_type, $user_id);

        return $data;
        //return Yii::$app->api->sendSuccessResponse($data->getModels());
    }

    /**
     * @param $user_id
     * @return ActiveDataProvider
     */
    public function actionActiveOrders($user_id)
    {
        $order_type_post = Yii::$app->request->post('ORDER_TYPE', 'ACTIVE');
        $order_type = strtoupper($order_type_post);
        return $this->getOrders($order_type, $user_id);
    }

    /**
     * @param $rider_id
     * @return ActiveDataProvider
     */
    public function actionRiderOrders($rider_id)
    {
        //$this->checkAccess('rider-orders');
        $order_type_post = Yii::$app->request->post('ORDER_TYPE', 'ACTIVE');
        $order_type = strtoupper($order_type_post);
        return $this->getOrders($order_type, null, $rider_id);
    }

    /**
     * @param $order_type
     * @param $user_id
     * @param int $rider_id
     * @return array|ActiveDataProvider
     */
    private function getOrders($order_type, $user_id, $rider_id = null)
    {

        $query = CUSTOMER_ORDER_MODEL::find();
        if ($rider_id != null) {
            $query->where(['RIDER_ID' => $rider_id]);
        } else {
            $query->where(['USER_ID' => $user_id]);
        }

        switch ($order_type) {
            case 'ACTIVE':
                $order_status = $this->activeOrders();
                break;
            case 'CONFIRMED':
                $order_status = $this->confirmedOrders();
                break;
            case 'CANCELLED':
                $order_status = $this->cancelledOrders();
                break;
            case 'UNPAID':
                $order_status = $this->unpaidOrders();
                break;
            case 'PENDING':
                $order_status = $this->pendingOrders();
                break;
            case 'DISPATCHED':
                $order_status = $this->dispatchedOrders();
                break;
            case 'DELIVERED':
                $order_status = $this->deliveredOrders();
                break;
            default:
                return [];

        }

        $query->andWhere(['ORDER_STATUS' => $order_status]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'ORDER_DATE' => SORT_DESC,
                ]
            ],
        ]);


    }

    /**
     * @return array
     */
    private function activeOrders()
    {
        return [
            ORDER_HELPER::STATUS_ORDER_PENDING,
            ORDER_HELPER::STATUS_PAYMENT_PENDING,
            ORDER_HELPER::STATUS_ORDER_CONFIRMED,
            ORDER_HELPER::STATUS_CHEF_ASSIGNED,
            ORDER_HELPER::STATUS_PAYMENT_CONFIRMED,
            ORDER_HELPER::STATUS_UNDER_PREPARATION,
            ORDER_HELPER::STATUS_AWAITING_RIDER,
            ORDER_HELPER::STATUS_RIDER_DISPATCHED,
            ORDER_HELPER::STATUS_KITCHEN_ASSIGNED
        ];

    }

    private function confirmedOrders()
    {
        return [
            ORDER_HELPER::STATUS_ORDER_CONFIRMED,
            ORDER_HELPER::STATUS_CHEF_ASSIGNED,
            ORDER_HELPER::STATUS_PAYMENT_CONFIRMED,
            ORDER_HELPER::STATUS_UNDER_PREPARATION,
            ORDER_HELPER::STATUS_AWAITING_RIDER,
            ORDER_HELPER::STATUS_RIDER_DISPATCHED
        ];

    }

    private function unpaidOrders()
    {
        return [ORDER_HELPER::STATUS_PAYMENT_PENDING, ORDER_HELPER::STATUS_ORDER_PENDING];

    }

    private function pendingOrders()
    {
        return [ORDER_HELPER::STATUS_ORDER_PENDING];

    }

    private function cancelledOrders()
    {
        return [ORDER_HELPER::STATUS_ORDER_CANCELLED];
    }

    private function dispatchedOrders()
    {
        return [ORDER_HELPER::STATUS_RIDER_DISPATCHED, ORDER_HELPER::STATUS_RIDER_ASSIGNED];
    }

    private function deliveredOrders()
    {
        return [ORDER_HELPER::STATUS_ORDER_DELIVERED];
    }
}