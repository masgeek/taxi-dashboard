<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "vw_orders".
 *
 * @property int $ORDER_ID
 * @property int $USER_ID
 * @property int $KITCHEN_ID
 * @property int $CHEF_ID
 * @property int $RIDER_ID
 * @property string $MOBILE
 * @property string $SURNAME
 * @property string $OTHER_NAMES
 * @property string $ORDER_DATE
 * @property string $ORDER_STATUS Status of the order
 * @property string $PAYMENT_AMOUNT
 * @property string $PAYMENT_NUMBER
 * @property string $NOTES Can contain payment text from mobile transactions etc
 * @property string $PAYMENT_METHOD
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property string $PAYMENT_DATE
 * @property int $LOCATION_ID
 * @property string $LOCATION_NAME
 * @property string $ADDRESS
 * @property string $CITY_NAME
 * @property int $CITY_ID
 * @property int $COUNRY_ID
 * @property string $COUNTRY_NAME
 * @property string $ORDER_TIME
 */
class VwOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ORDER_ID', 'USER_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID', 'LOCATION_ID', 'CITY_ID', 'COUNRY_ID'], 'integer'],
            [['USER_ID', 'MOBILE', 'SURNAME', 'OTHER_NAMES', 'ORDER_DATE', 'ORDER_STATUS', 'PAYMENT_METHOD', 'LOCATION_NAME', 'CITY_NAME', 'COUNTRY_NAME'], 'required'],
            [['ORDER_DATE', 'CREATED_AT', 'UPDATED_AT', 'PAYMENT_DATE'], 'safe'],
            [['PAYMENT_AMOUNT'], 'number'],
            [['ADDRESS'], 'string'],
            [['MOBILE'], 'string', 'max' => 25],
            [['SURNAME', 'OTHER_NAMES', 'CITY_NAME', 'COUNTRY_NAME'], 'string', 'max' => 100],
            [['ORDER_STATUS', 'PAYMENT_NUMBER'], 'string', 'max' => 30],
            [['NOTES', 'LOCATION_NAME'], 'string', 'max' => 255],
            [['PAYMENT_METHOD', 'ORDER_TIME'], 'string', 'max' => 20],
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
            'KITCHEN_ID' => 'K I T C H E N I D',
            'CHEF_ID' => 'C H E F I D',
            'RIDER_ID' => 'R I D E R I D',
            'MOBILE' => 'M O B I L E',
            'SURNAME' => 'S U R N A M E',
            'OTHER_NAMES' => 'O T H E R N A M E S',
            'ORDER_DATE' => 'O R D E R D A T E',
            'ORDER_STATUS' => 'Status of the order',
            'PAYMENT_AMOUNT' => 'P A Y M E N T A M O U N T',
            'PAYMENT_NUMBER' => 'P A Y M E N T N U M B E R',
            'NOTES' => 'Can contain payment text from mobile transactions etc',
            'PAYMENT_METHOD' => 'P A Y M E N T M E T H O D',
            'CREATED_AT' => 'C R E A T E D A T',
            'UPDATED_AT' => 'U P D A T E D A T',
            'PAYMENT_DATE' => 'P A Y M E N T D A T E',
            'LOCATION_ID' => 'L O C A T I O N I D',
            'LOCATION_NAME' => 'L O C A T I O N N A M E',
            'ADDRESS' => 'A D D R E S S',
            'CITY_NAME' => 'C I T Y N A M E',
            'CITY_ID' => 'C I T Y I D',
            'COUNRY_ID' => 'C O U N R Y I D',
            'COUNTRY_NAME' => 'C O U N T R Y N A M E',
            'ORDER_TIME' => 'O R D E R T I M E',
        ];
    }
}
