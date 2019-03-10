<?php

namespace common\models;

use \common\models\base\VwOrders as BaseVwOrders;

/**
 * This is the model class for table "vw_orders".
 */
class VwOrders extends BaseVwOrders
{
    public static function primaryKey()
    {
        return ['ORDER_ID'];
    }

    public $START_DATE;
    public $END_DATE;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['ORDER_ID', 'USER_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID', 'LOCATION_ID', 'CITY_ID', 'COUNRY_ID'], 'integer'],
                [['USER_ID', 'MOBILE', 'SURNAME', 'OTHER_NAMES', 'ORDER_DATE', 'ORDER_STATUS', 'PAYMENT_METHOD', 'LOCATION_NAME', 'CITY_NAME', 'COUNTRY_NAME'], 'required'],
                [['ORDER_DATE', 'CREATED_AT', 'UPDATED_AT', 'PAYMENT_DATE'], 'safe'],
                [['PAYMENT_AMOUNT'], 'number'],
                [['ADDRESS'], 'string'],
                [['MOBILE'], 'string', 'max' => 25],
                [['SURNAME', 'OTHER_NAMES', 'CITY_NAME', 'COUNTRY_NAME'], 'string', 'max' => 100],
                [['ORDER_STATUS', 'PAYMENT_NUMBER'], 'string', 'max' => 30],
                [['NOTES', 'LOCATION_NAME'], 'string', 'max' => 255],
                [['PAYMENT_METHOD', 'ORDER_TIME'], 'string', 'max' => 20]
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['LOCATION_ID'] = 'Delivery Address';
        $labels['KITCHEN_ID'] = 'Assign Kitchen';
        $labels['CHEF_ID'] = 'Assign Chef';
        $labels['RIDER_ID'] = 'Assign Rider';
        $labels['NOTES'] = 'Notes';
        $labels['ORDER_PRICE'] = 'Total';
        $labels['PAYMENT_METHOD'] = 'Payment';
        $labels['ORDER_STATUS'] = 'Status';
        $labels['ORDER_ID'] = 'Order ID #';
        $labels['ORDER_DATE'] = 'Order Date';
        $labels['ORDER_TIME'] = 'Delivery Time';
        $labels['SURNAME'] = 'Surname';
        $labels['OTHER_NAMES'] = 'Other Names';
        $labels['CITY_NAME'] = 'City';
        $labels['COUNTRY_NAME'] = 'Country';
        $labels['MOBILE'] = 'Mobile';


        return $labels;
    }
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return $this->attributeLabels();
    }

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
    public function getLOCATION()
    {
        return $this->hasOne(Location::className(), ['LOCATION_ID' => 'LOCATION_ID']);
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
    public function getCustomerOrderItems()
    {
        return $this->hasMany(CustomerOrderItem::className(), ['ORDER_ID' => 'ORDER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTrackings()
    {
        return $this->hasMany(OrderTracking::className(), ['ORDER_ID' => 'ORDER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getStatuses()
    {
        return $this->hasMany(Status::className(), ['STATUS_NAME' => 'STATUS'])->viaTable('order_tracking', ['ORDER_ID' => 'ORDER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['ORDER_ID' => 'ORDER_ID']);
    }
}
