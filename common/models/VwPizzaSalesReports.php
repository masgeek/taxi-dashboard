<?php

namespace common\models;

use \common\models\base\VwPizzaSalesReports as BaseVwPizzaSalesReports;

/**
 * This is the model class for table "vw_pizza_sales_reports".
 */
class VwPizzaSalesReports extends BaseVwPizzaSalesReports
{
    public $START_DATE;
    public $END_DATE;
    public $ORDER_TOTAL;

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
}
