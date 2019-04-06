<?php

namespace common\models;

use common\models\base\Cart as BaseCart;

/**
 * This is the model class for table "tb_cart".
 */
class Cart extends BaseCart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['USER_ID', 'ITEM_TYPE_ID', 'QUANTITY', 'ITEM_PRICE', 'ITEM_TYPE_SIZE'], 'required'],
            [['USER_ID', 'ITEM_TYPE_ID', 'QUANTITY', 'CART_TIMESTAMP'], 'integer'],
            [['ITEM_PRICE'], 'number'],
            [['CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['ITEM_TYPE_SIZE'], 'string', 'max' => 15],
            [['NOTES'], 'string', 'max' => 255]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'CART_ITEM_ID' => 'C A R T I T E M I D',
            'USER_ID' => 'U S E R I D',
            'ITEM_TYPE_ID' => 'I T E M T Y P E I D',
            'QUANTITY' => 'Q U A N T I T Y',
            'ITEM_PRICE' => 'I T E M P R I C E',
            'ITEM_TYPE_SIZE' => 'I T E M T Y P E S I Z E',
            'NOTES' => 'N O T E S',
            'CART_TIMESTAMP' => 'C A R T T I M E S T A M P',
            'CREATED_AT' => 'C R E A T E D A T',
            'UPDATED_AT' => 'U P D A T E D A T',
        ];
    }
}
