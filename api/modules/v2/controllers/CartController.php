<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace api\modules\v2\controllers;

use api\behaviours\Apiauth;
use api\models\CART_MODEL;
use common\controllers\BaseRestController;
use common\helper\APP_UTILS;
use common\helper\OrderHelper as ORDER_HELPER;
use common\models\search\CartSearch;
use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;


class CartController extends BaseRestController
{
    /**
     * @var object
     */
    public $modelClass = 'api\models\CART_MODEL';

    private $_apiToken = 0;
    private $_userID = 0;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['apiauth'] = [
            'class' => Apiauth::class,
            'exclude' => ['index','view','update-cart','items'],
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {

        $searchModel = new CartSearch();

        return $searchModel->search(\Yii::$app->request->queryParams);
    }

    public function actionUpdateCart($id)
    {
        $post = Yii::$app->request->post();

        $cart = CART_MODEL::findOne($id);

        if ($cart->load(['CART_MODEL' => $post]) && $cart->save()) {
            return $cart;
        }

        $cart->validate();

        return $cart->getErrors();
    }


    public function actionItems($user_id)
    {
        $cartItems = CART_MODEL::find()
            ->where(['USER_ID' => $user_id])
            ->all();

        return $cartItems;
    }

    /**
     * @param $item_type_id
     * @param $user_id
     * @return CART_MODEL|array|null|\yii\db\ActiveRecord
     * @throws ForbiddenHttpException
     */
    public function actionInCart($item_type_id, $user_id)
    {
        $this->checkAccess('in-cart');
        $size = \Yii::$app->request->post('ITEM_TYPE_SIZE', null); //'MEDIUM';
        $inCart = CART_MODEL::find()
            ->where(['ITEM_TYPE_ID' => $item_type_id])
            ->andWhere(['USER_ID' => $user_id])
            ->andWhere(['ITEM_TYPE_SIZE' => $size])
            ->one();

        return $inCart;
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function actionCreateOrder()
    {
        //$cart_timestamp = Yii::$app->request->post('CART_TIMESTAMP', 0);
        $user_id = Yii::$app->request->post('USER_ID', 0);
        $location_id = Yii::$app->request->post('LOCATION_ID', 0);
        $order_time = Yii::$app->request->post('ORDER_TIME', 0);
        $payment_channel = Yii::$app->request->post('PAYMENT_CHANNEL', APP_UTILS::PAYMENT_METHOD_MOBILE);


        $date = APP_UTILS::GetCurrentDateTime();
        $order_payment_arr = [
            'CUSTOMER_ORDERS' => [
                'USER_ID' => $user_id,
                'LOCATION_ID' => $location_id,
                'PAYMENT_METHOD' => $payment_channel,
                'ORDER_DATE' => $date,
                'ORDER_TIME' => $order_time
            ]
        ];

        return ORDER_HELPER::CreateOrderFromCart($user_id, $order_payment_arr);

    }

    public function actionUssd()
    {
        return ['USSD_NUMBER' => ORDER_HELPER::getUssdNumber()];
    }

    public function actionMinPrice()
    {
        return ['minPrice' => ORDER_HELPER::getMinPrice()];
    }
}