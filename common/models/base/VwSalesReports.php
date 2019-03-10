<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "vw_sales_reports".
 *
 * @property int $ORDER_ID
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
 * @property int $USER_ID
 * @property string $USER_NAME
 * @property int $USER_TYPE
 * @property string $SURNAME
 * @property string $OTHER_NAMES
 * @property string $LOCATION_NAME
 * @property int $COUNTRY_ID
 * @property string $CHEF_NAME
 */
class VwSalesReports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_sales_reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ORDER_ID', 'LOCATION_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID', 'USER_ID', 'USER_TYPE', 'COUNTRY_ID'], 'integer'],
            [['LOCATION_ID', 'ORDER_DATE', 'PAYMENT_METHOD', 'ORDER_STATUS', 'USER_NAME', 'USER_TYPE', 'SURNAME', 'OTHER_NAMES', 'LOCATION_NAME', 'COUNTRY_ID', 'CHEF_NAME'], 'required'],
            [['ORDER_DATE', 'CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['PAYMENT_METHOD', 'ORDER_TIME'], 'string', 'max' => 20],
            [['ORDER_STATUS'], 'string', 'max' => 30],
            [['NOTES', 'LOCATION_NAME'], 'string', 'max' => 255],
            [['USER_NAME', 'SURNAME', 'OTHER_NAMES', 'CHEF_NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ORDER_ID' => 'O R D E R I D',
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
            'USER_ID' => 'U S E R I D',
            'USER_NAME' => 'U S E R N A M E',
            'USER_TYPE' => 'U S E R T Y P E',
            'SURNAME' => 'S U R N A M E',
            'OTHER_NAMES' => 'O T H E R N A M E S',
            'LOCATION_NAME' => 'L O C A T I O N N A M E',
            'COUNTRY_ID' => 'C O U N T R Y I D',
            'CHEF_NAME' => 'C H E F N A M E',
        ];
    }
}
