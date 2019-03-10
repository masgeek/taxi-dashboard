<?php

namespace common\models;

use \common\models\base\VwSalesReports as BaseVwSalesReports;
use common\helper\OrderHelper as ORDER_HELPER;

/**
 * This is the model class for table "vw_sales_reports".
 */
class VwSalesReports extends BaseVwSalesReports
{
    public $START_DATE;
    public $END_DATE;
    public $ORDER_TOTAL;

    const CONTEXT_ORDERS = 'orders-search';
    const CONTEXT_GENERAL = 'general-search';
    const CONTEXT_SALES = 'sales-search';
    const CONTEXT_RIDER = 'rider-search';
    const CONTEXT_CHEF = 'chef-search';
    const CONTEXT_KITCHEN = 'kitchen-search';
    const CONTEXT_LOCATION = 'location-search';

    public static function primaryKey()
    {
        return ['ORDER_ID'];
    }


    public function attributeLabels()
    {
        //$labels = parent::attributeLabels();
        $labels = [
            'ORDER_ID' => 'Order  ID',
            'LOCATION_ID' => 'Location',
            'KITCHEN_ID' => 'Kitchen',
            'CHEF_ID' => 'Chef',
            'RIDER_ID' => 'Rider',
            'ORDER_DATE' => 'Order Date',
            'PAYMENT_METHOD' => 'Payment Method',
            'ORDER_STATUS' => 'Order Status',
            'ORDER_TIME' => 'Order Time',
            'NOTES' => 'Can contain payment text from mobile transactions etc',
            'CREATED_AT' => 'Created',
            'UPDATED_AT' => 'Updated',
            'USER_ID' => 'Customer',
            'USER_NAME' => 'Customer Username',
            'USER_TYPE' => 'User Type',
            'SURNAME' => 'Surname',
            'OTHER_NAMES' => 'Other Names',
            'LOCATION_NAME' => 'Location Name',
            'COUNTRY_ID' => 'Country ID',
            'CHEF_NAME' => 'Chef Name',
        ];

        return $labels;
    }

    /** Create relations here  **/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(Users::className(), ['USER_ID' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRIDER()
    {
        return $this->hasOne(Riders::className(), ['RIDER_ID' => 'RIDER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKITCHEN()
    {
        return $this->hasOne(Kitchen::className(), ['KITCHEN_ID' => 'KITCHEN_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getORDERSTATUS()
    {
        return $this->hasOne(Status::className(), ['STATUS_NAME' => 'ORDER_STATUS']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCHEF()
    {
        return $this->hasOne(Chef::className(), ['CHEF_ID' => 'CHEF_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLOCATION()
    {
        return $this->hasOne(Location::className(), ['LOCATION_ID' => 'LOCATION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOrderItems()
    {
        return $this->hasMany(CustomerOrderItem::className(), ['ORDER_ID' => 'ORDER_ID']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['ORDER_ID' => 'ORDER_ID']);
    }

    public static function getOrderStatuses()
    {
        $status = [
            ORDER_HELPER::STATUS_ORDER_CANCELLED => 'Cancelled Orders',
            ORDER_HELPER::STATUS_ORDER_PENDING => 'Unpaid Orders',
            ORDER_HELPER::STATUS_PAYMENT_CONFIRMED => 'Paid Orders',
            //ORDER_HELPER::STATUS_PAYMENT_PENDING=> 'Unpaid Orders',
            ORDER_HELPER::STATUS_ORDER_CONFIRMED => 'Order Confirmed',
            ORDER_HELPER::STATUS_KITCHEN_ASSIGNED => 'Kitchen Assigned',
            ORDER_HELPER::STATUS_CHEF_ASSIGNED => 'Chef Assigned',
            ORDER_HELPER::STATUS_UNDER_PREPARATION => 'Orders being prepared',
            ORDER_HELPER::STATUS_ORDER_READY => 'Order Ready',
            ORDER_HELPER::STATUS_AWAITING_RIDER => 'Awaiting Rider',
            ORDER_HELPER::STATUS_RIDER_ASSIGNED => 'Rider Assigned',
            ORDER_HELPER::STATUS_RIDER_DISPATCHED => 'Rider Dispatched',
            ORDER_HELPER::STATUS_ORDER_DELIVERED => 'Order Delivered',
        ];

        asort($status);
        return $status;
    }
}
