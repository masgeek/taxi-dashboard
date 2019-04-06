<?php

namespace common\models;

use common\models\base\OrderTracking as BaseOrderTracking;

/**
 * This is the model class for table "order_tracking".
 */
class OrderTracking extends BaseOrderTracking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ORDER_ID', 'STATUS'], 'required'],
            [['ORDER_ID'], 'integer'],
            [['TRACKING_DATE'], 'safe'],
            [['USER_VISIBLE'], 'boolean'],
            [['COMMENTS'], 'string', 'max' => 255],
            [['STATUS'], 'string', 'max' => 30],
            [['ORDER_ID', 'STATUS'], 'unique', 'targetAttribute' => ['ORDER_ID', 'STATUS'], 'message' => 'The combination of O R D E R I D and S T A T U S has already been taken.']
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'TRACKING_ID' => 'T R A C K I N G I D',
            'ORDER_ID' => 'O R D E R I D',
            'COMMENTS' => 'C O M M E N T S',
            'STATUS' => 'S T A T U S',
            'TRACKING_DATE' => 'T R A C K I N G D A T E',
            'USER_VISIBLE' => 'U S E R V I S I B L E',
        ];
    }
}
