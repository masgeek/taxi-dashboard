<?php

namespace common\models;

use \common\models\base\Payment as BasePayment;

/**
 * This is the model class for table "payment".
 */
class Payment extends BasePayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ORDER_ID'], 'integer'],
            [['PAYMENT_CHANNEL', 'PAYMENT_AMOUNT', 'PAYMENT_REF', 'PAYMENT_DATE'], 'required'],
            [['PAYMENT_AMOUNT'], 'number'],
            [['PAYMENT_DATE'], 'safe'],
            [['PAYMENT_CHANNEL', 'PAYMENT_REF', 'PAYMENT_NOTES'], 'string', 'max' => 255],
            [['PAYMENT_STATUS', 'PAYMENT_NUMBER'], 'string', 'max' => 30]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'PAYMENT_ID' => 'P A Y M E N T I D',
            'ORDER_ID' => 'O R D E R I D',
            'PAYMENT_CHANNEL' => 'P A Y M E N T C H A N N E L',
            'PAYMENT_AMOUNT' => 'P A Y M E N T A M O U N T',
            'PAYMENT_REF' => 'P A Y M E N T R E F',
            'PAYMENT_STATUS' => 'P A Y M E N T S T A T U S',
            'PAYMENT_DATE' => 'P A Y M E N T D A T E',
            'PAYMENT_NOTES' => 'P A Y M E N T N O T E S',
            'PAYMENT_NUMBER' => 'P A Y M E N T N U M B E R',
        ];
    }
}
