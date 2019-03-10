<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "vw_order_items".
 *
 * @property int $ORDER_ID
 * @property int $QUANTITY
 * @property string $PRICE
 * @property string $SUBTOTAL
 * @property string $ITEM_TYPE_SIZE
 * @property string $MENU_ITEM_NAME
 * @property string $MENU_CAT_NAME
 * @property string $MENU_CAT_IMAGE
 * @property string $MENU_ITEM_IMAGE
 * @property int $USER_ID
 */
class VwOrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ORDER_ID', 'QUANTITY', 'USER_ID'], 'integer'],
            [['QUANTITY', 'PRICE', 'SUBTOTAL', 'MENU_ITEM_NAME', 'MENU_CAT_NAME', 'MENU_ITEM_IMAGE', 'USER_ID'], 'required'],
            [['PRICE', 'SUBTOTAL'], 'number'],
            [['ITEM_TYPE_SIZE'], 'string', 'max' => 15],
            [['MENU_ITEM_NAME', 'MENU_CAT_IMAGE', 'MENU_ITEM_IMAGE'], 'string', 'max' => 255],
            [['MENU_CAT_NAME'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
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
