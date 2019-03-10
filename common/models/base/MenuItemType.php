<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "menu_item_type".
 *
 * @property int $ITEM_TYPE_ID
 * @property int $MENU_ITEM_ID
 * @property string $ITEM_TYPE_SIZE
 * @property string $PRICE
 * @property bool $AVAILABLE
 *
 * @property CustomerOrderItem[] $customerOrderItems
 * @property MenuItem $mENUITEM
 * @property Sizes $iTEMTYPESIZE
 * @property Cart[] $carts
 * @property WpCart[] $wpCarts
 */
class MenuItemType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_item_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MENU_ITEM_ID', 'PRICE'], 'required'],
            [['MENU_ITEM_ID'], 'integer'],
            [['PRICE'], 'number'],
            [['AVAILABLE'], 'boolean'],
            [['ITEM_TYPE_SIZE'], 'string', 'max' => 15],
            [['ITEM_TYPE_SIZE', 'MENU_ITEM_ID'], 'unique', 'targetAttribute' => ['ITEM_TYPE_SIZE', 'MENU_ITEM_ID']],
            [['MENU_ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MenuItem::className(), 'targetAttribute' => ['MENU_ITEM_ID' => 'MENU_ITEM_ID']],
            [['ITEM_TYPE_SIZE'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['ITEM_TYPE_SIZE' => 'SIZE_TYPE']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ITEM_TYPE_ID' => 'I T E M T Y P E I D',
            'MENU_ITEM_ID' => 'M E N U I T E M I D',
            'ITEM_TYPE_SIZE' => 'I T E M T Y P E S I Z E',
            'PRICE' => 'P R I C E',
            'AVAILABLE' => 'A V A I L A B L E',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOrderItems()
    {
        return $this->hasMany(CustomerOrderItem::className(), ['ITEM_TYPE_ID' => 'ITEM_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENUITEM()
    {
        return $this->hasOne(MenuItem::className(), ['MENU_ITEM_ID' => 'MENU_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMTYPESIZE()
    {
        return $this->hasOne(Sizes::className(), ['SIZE_TYPE' => 'ITEM_TYPE_SIZE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['ITEM_TYPE_ID' => 'ITEM_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWpCarts()
    {
        return $this->hasMany(WpCart::className(), ['ITEM_TYPE_ID' => 'ITEM_TYPE_ID']);
    }
}
