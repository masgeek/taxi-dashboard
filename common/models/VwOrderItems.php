<?php

namespace common\models;

use common\models\base\VwOrderItems as BaseVwOrderItems;

/**
 * This is the model class for table "vw_order_items".
 */
class VwOrderItems extends BaseVwOrderItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ORDER_ID', 'QUANTITY', 'USER_ID'], 'integer'],
            [['QUANTITY', 'PRICE', 'SUBTOTAL', 'MENU_ITEM_NAME', 'MENU_CAT_NAME', 'MENU_ITEM_IMAGE', 'USER_ID'], 'required'],
            [['PRICE', 'SUBTOTAL'], 'number'],
            [['ITEM_TYPE_SIZE'], 'string', 'max' => 15],
            [['MENU_ITEM_NAME', 'MENU_CAT_IMAGE', 'MENU_ITEM_IMAGE'], 'string', 'max' => 255],
            [['MENU_CAT_NAME'], 'string', 'max' => 50]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'ORDER_ID' => 'O R D E R I D',
            'QUANTITY' => 'Q U A N T I T Y',
            'PRICE' => 'P R I C E',
            'SUBTOTAL' => 'S U B T O T A L',
            'ITEM_TYPE_SIZE' => 'I T E M T Y P E S I Z E',
            'MENU_ITEM_NAME' => 'M E N U I T E M N A M E',
            'MENU_CAT_NAME' => 'M E N U C A T N A M E',
            'MENU_CAT_IMAGE' => 'M E N U C A T I M A G E',
            'MENU_ITEM_IMAGE' => 'M E N U I T E M I M A G E',
            'USER_ID' => 'U S E R I D',
        ];
    }
}
