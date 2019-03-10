<?php

namespace common\models;

use \common\models\base\WpCart as BaseWpCart;

/**
 * This is the model class for table "wp_cart".
 */
class WpCart extends BaseWpCart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['CART_GUID'], 'string'],
            [['ITEM_TYPE_ID', 'QUANTITY', 'ITEM_PRICE', 'ITEM_TYPE_SIZE'], 'required'],
            [['ITEM_TYPE_ID', 'QUANTITY'], 'integer'],
            [['ITEM_PRICE'], 'number'],
            [['ITEM_TYPE_SIZE'], 'string', 'max' => 15]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'CART_ITEM_ID' => 'C A R T I T E M I D',
            'CART_GUID' => 'C A R T G U I D',
            'ITEM_TYPE_ID' => 'I T E M T Y P E I D',
            'QUANTITY' => 'Q U A N T I T Y',
            'ITEM_PRICE' => 'I T E M P R I C E',
            'ITEM_TYPE_SIZE' => 'I T E M T Y P E S I Z E',
        ];
    }
}
