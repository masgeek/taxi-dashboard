<?php

namespace common\models;

use common\models\base\DeliveryTime as BaseDeliveryTime;

/**
 * This is the model class for table "tb_delivery_time".
 */
class DeliveryTime extends BaseDeliveryTime
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['DELIVERY_TIME'], 'required'],
            [['DELIVERY_TIME'], 'string', 'max' => 20],
            [['DELIVERY_TIME'], 'unique']
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'TIME_ID' => 'T I M E I D',
            'DELIVERY_TIME' => 'D E L I V E R Y T I M E',
        ];
    }
}
