<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 11/4/2017
 * Time: 9:43 AM
 */

namespace common\helper;

use common\models\Cart as CART_MODEL;


use common\models\CustomerOrderItem as CUSTOMER_ORDER_ITEMS;
use common\models\CustomerOrder as CUSTOMER_ORDERS;
use common\models\Payment as CUSTOMER_PAYMENTS;
use common\models\Status as STATUS_MODEL;
use common\models\WpCart as WP_CART_MODEL;
use Yii;

class OrderHelper
{
    const STATUS_ORDER_CANCELLED = 'ORDER CANCELLED';
    const STATUS_ORDER_PENDING = 'ORDER PENDING';
    const STATUS_PAYMENT_CONFIRMED = 'ORDER CONFIRMED';
    const STATUS_PAYMENT_PENDING = 'PAYMENT PENDING';
    const STATUS_ORDER_CONFIRMED = 'ORDER CONFIRMED';
    const STATUS_KITCHEN_ASSIGNED = 'KITCHEN ALLOCATED';
    const STATUS_CHEF_ASSIGNED = 'CHEF ASSIGNED';
    const STATUS_UNDER_PREPARATION = 'UNDER PREPARATION';
    const STATUS_ORDER_READY = 'ORDER READY';
    const STATUS_AWAITING_RIDER = 'AWAITING RIDER';
    const STATUS_RIDER_ASSIGNED = 'RIDER ASSIGNED';
    const STATUS_RIDER_DISPATCHED = 'RIDER DISPATCHED';
    const STATUS_ORDER_DELIVERED = 'ORDER DELIVERED';


    /**
     * @param $order_id
     * @param $scope
     * @return int|mixed
     */
    public static function NextWorkFlow($order_id, $scope)
    {
        $usedFlows = STATUS_MODEL::StatusExclusionList($order_id);

        $status = STATUS_MODEL::find()
            ->where(['SCOPE' => $scope])
            ->andWhere(['NOT IN', 'STATUS_NAME', $usedFlows])
            ->orderBy(['RANK' => SORT_ASC])
            ->one();

        return $status != null ? $status->WORKFLOW : 0;
    }


    /**
     * @param $user_id
     * @param array $order_payment_arr
     * @param array $cart_items
     * @param bool $isCard
     * @return array|bool
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public static function CreateOrderFromCart($user_id, array $order_payment_arr, array $cart_items = [], $isCard = false)
    {
        /* @var $orderItems CART_MODEL */
        $session = Yii::$app->session;
        $connection = \Yii::$app->db;
        $currentDate = APP_UTILS::GetCurrentDateTime();
        $saveSuccessful = false;
        $cart_timestamp = null;
        $ussdNumber = self::getUssdNumber();
        $resp = [
            'ORDER_CREATED' => $saveSuccessful,
            'ORDER_ID' => 0,
            'USSD_NUMBER' => $ussdNumber
        ];
        if (count($cart_items) <= 0) {
            $cart_items = self::GetCartItems($user_id);
        }

        $paymentModel = new CUSTOMER_PAYMENTS();
        $customer_order = new CUSTOMER_ORDERS();
        $customer_order_items = new CUSTOMER_ORDER_ITEMS();
        $customer_order->ORDER_STATUS = $isCard ? self::STATUS_ORDER_CONFIRMED : self::STATUS_PAYMENT_PENDING;

        if ($customer_order->load($order_payment_arr)) {
            $transaction = $connection->beginTransaction();
            if ($customer_order->save()) {
                foreach ($cart_items as $key => $orderItems):
                    $customer_order_items->isNewRecord = true;
                    $customer_order_items->ORDER_ITEM_ID = null;
                    $customer_order_items->ORDER_ID = $customer_order->ORDER_ID;
                    $customer_order_items->ITEM_TYPE_ID = $orderItems->ITEM_TYPE_ID;
                    $customer_order_items->QUANTITY = $orderItems->QUANTITY;
                    $customer_order_items->PRICE = (int)$orderItems->ITEM_PRICE;
                    $customer_order_items->SUBTOTAL = (int)$orderItems->ITEM_PRICE * (float)$orderItems->QUANTITY;
                    $customer_order_items->OPTIONS = 'N/A';
                    $customer_order_items->NOTES = $customer_order->NOTES;
                    $customer_order_items->CREATED_AT = $currentDate;

                    //save the order items
                    if (!$customer_order_items->save()) {
                        return false;
                    }

                    $cart_timestamp = $orderItems->CART_TIMESTAMP;
                endforeach;
                $saveSuccessful = true;
            }

            if ($saveSuccessful) {
                $transaction->commit();
                //if it is card redirect to  card checkout
                if ($customer_order->PAYMENT_METHOD === APP_UTILS::PAYMENT_METHOD_CARD) {
                    //Add cart timestamp to the session
                    $session->set('CART_TIMESTAMP', $cart_timestamp);
                } else {
                    //remove the cart item
                    CART_MODEL::ClearCart($cart_timestamp);
                    $resp = [
                        'ORDER_CREATED' => $saveSuccessful,
                        'ORDER_ID' => (int)$customer_order->ORDER_ID,
                        'USSD_NUMBER' => $ussdNumber
                    ];
                }
            } else {
                $transaction->rollback();
            }
        }
        return $resp;
    }


    /**
     * @return mixed
     */
    public static function getUssdNumber()
    {
        return Yii::$app->params['ussdNumber'];
    }

    /**
     * @return int
     */
    public static function getVatRate()
    {
        return Yii::$app->params['vatRate'];
    }

    public static function getTagLine()
    {
        return Yii::$app->params['tagLine'];
    }

    /**
     * @param $user_id
     * @param array $order_payment_arr
     * @param array $cart_items
     * @param bool $isCard
     * @return bool
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     *
     * @deprecated
     */
    public static function CreateOrderFromCartOld($user_id, array $order_payment_arr, array $cart_items = [], $isCard = false)
    {
        /* @var $orderItems CART_MODEL */
        $session = Yii::$app->session;
        $connection = \Yii::$app->db;
        $currentDate = APP_UTILS::GetCurrentDateTime();
        $saveSuccessful = false;
        $cart_timestamp = null;

        if (count($cart_items) <= 0) {
            $cart_items = self::GetCartItems($user_id);
        }

        $paymentModel = new CUSTOMER_PAYMENTS();
        $customer_order = new CUSTOMER_ORDERS();
        $customer_order_items = new CUSTOMER_ORDER_ITEMS();
        $customer_order->ORDER_STATUS = $isCard ? self::STATUS_ORDER_CONFIRMED : self::STATUS_ORDER_PENDING;

        if ($customer_order->load($order_payment_arr)) {
            $transaction = $connection->beginTransaction();
            $paymentModel->load($order_payment_arr);
            if ($customer_order->save()) {
                foreach ($cart_items as $key => $orderItems):
                    $customer_order_items->isNewRecord = true;
                    $customer_order_items->ORDER_ITEM_ID = null;
                    $customer_order_items->ORDER_ID = $customer_order->ORDER_ID;
                    $customer_order_items->ITEM_TYPE_ID = $orderItems->ITEM_TYPE_ID;
                    $customer_order_items->QUANTITY = $orderItems->QUANTITY;
                    $customer_order_items->PRICE = (int)$orderItems->ITEM_PRICE;
                    $customer_order_items->SUBTOTAL = (int)$orderItems->ITEM_PRICE * (float)$orderItems->QUANTITY;
                    $customer_order_items->OPTIONS = 'N/A';
                    $customer_order_items->NOTES = $customer_order->NOTES;
                    $customer_order_items->CREATED_AT = $currentDate;

                    //save the order items
                    if (!$customer_order_items->save()) {
                        return false;
                    }

                    $cart_timestamp = $orderItems->CART_TIMESTAMP;
                endforeach;

                $paymentModel->ORDER_ID = $customer_order->ORDER_ID;
                $paymentModel->PAYMENT_STATUS = $isCard ? self::STATUS_PAYMENT_CONFIRMED : self::STATUS_PAYMENT_PENDING;

                if ($paymentModel->validate() && $paymentModel->save()) {
                    $saveSuccessful = true;
                } else {
                    $saveSuccessful = false;
                }
            }

            if ($saveSuccessful) {
                $transaction->commit();
                //if it is card redirect to  card checkout
                if ($customer_order->PAYMENT_METHOD === APP_UTILS::PAYMENT_METHOD_CARD) {
                    //Add cart timestamp to the session
                    $session->set('CART_TIMESTAMP', $cart_timestamp);
                } else {
                    //remove the cart item
                    CART_MODEL::ClearCart($cart_timestamp);
                }
            } else {
                $transaction->rollback();
            }
        }
        return $saveSuccessful;
    }

    /**
     * @param $user_id
     * @return CART_MODEL[]|WP_CART_MODEL[]|array|\yii\db\ActiveRecord[]
     */
    public static function GetCartItems($user_id)
    {
        $cart_items = CART_MODEL::find()
            ->where(['USER_ID' => $user_id])
            ->all();
        return $cart_items;
    }

    /**
     * @param $cart_guid
     * @return CART_MODEL[]|WP_CART_MODEL[]|array|\yii\db\ActiveRecord[]
     */
    public static function GetWpCartItems($cart_guid)
    {
        $cart_items = WP_CART_MODEL::find()
            ->where(['CART_GUID' => $cart_guid])
            ->all();

        return $cart_items;
    }

    public static function getMinPrice()
    {
        $min_price = \Yii::$app->params['min_price'];
        return (float)\Yii::$app->formatter->asDecimal($min_price, 2);
    }
}