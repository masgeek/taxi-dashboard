<?php

namespace common\models\base;

/**
 * This is the model class for table "customer_order".
 *
 * @property int $ORDER_ID
 * @property int $USER_ID
 * @property int $LOCATION_ID
 * @property int $KITCHEN_ID
 * @property int $CHEF_ID
 * @property int $RIDER_ID
 * @property string $ORDER_DATE
 * @property string $PAYMENT_METHOD
 * @property string $ORDER_STATUS Status of the order
 * @property string $ORDER_TIME
 * @property string $NOTES Can contain payment text from mobile transactions etc
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 *
 * @property Users $uSER
 * @property Riders $rIDER
 * @property Kitchen $kITCHEN
 * @property Status $oRDERSTATUS
 * @property Chef $cHEF
 * @property Location $lOCATION
 * @property CustomerOrderItem[] $customerOrderItems
 * @property OrderTracking[] $orderTrackings
 * @property Status[] $statuses
 * @property Payment[] $payments
 */
class CustomerOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER_ID', 'LOCATION_ID', 'ORDER_DATE', 'PAYMENT_METHOD', 'ORDER_STATUS'], 'required'],
            [['USER_ID', 'LOCATION_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID'], 'integer'],
            [['ORDER_DATE', 'CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['PAYMENT_METHOD', 'ORDER_TIME'], 'string', 'max' => 20],
            [['ORDER_STATUS'], 'string', 'max' => 30],
            [['NOTES'], 'string', 'max' => 255],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['USER_ID' => 'USER_ID']],
            [['RIDER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Riders::className(), 'targetAttribute' => ['RIDER_ID' => 'RIDER_ID']],
            [['KITCHEN_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Kitchen::className(), 'targetAttribute' => ['KITCHEN_ID' => 'KITCHEN_ID']],
            [['ORDER_STATUS'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['ORDER_STATUS' => 'STATUS_NAME']],
            [['CHEF_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Chef::className(), 'targetAttribute' => ['CHEF_ID' => 'CHEF_ID']],
            [['LOCATION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['LOCATION_ID' => 'LOCATION_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ORDER_ID' => 'O R D E R I D',
            'USER_ID' => 'U S E R I D',
            'LOCATION_ID' => 'L O C A T I O N I D',
            'KITCHEN_ID' => 'K I T C H E N I D',
            'CHEF_ID' => 'C H E F I D',
            'RIDER_ID' => 'R I D E R I D',
            'ORDER_DATE' => 'O R D E R D A T E',
            'PAYMENT_METHOD' => 'P A Y M E N T M E T H O D',
            'ORDER_STATUS' => 'Status of the order',
            'ORDER_TIME' => 'O R D E R T I M E',
            'NOTES' => 'Can contain payment text from mobile transactions etc',
            'CREATED_AT' => 'C R E A T E D A T',
            'UPDATED_AT' => 'U P D A T E D A T',
        ];
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
    public function getOrderTrackings()
    {
        return $this->hasMany(OrderTracking::className(), ['ORDER_ID' => 'ORDER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
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
