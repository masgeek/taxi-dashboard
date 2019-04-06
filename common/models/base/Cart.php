<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property int $CART_ITEM_ID
 * @property int $USER_ID
 * @property int $ITEM_TYPE_ID
 * @property int $QUANTITY
 * @property string $ITEM_PRICE
 * @property string $ITEM_TYPE_SIZE
 * @property string $NOTES
 * @property int $CART_TIMESTAMP
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 *
 * @property MenuItemType $iTEMTYPE
 * @property Users $uSER
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER_ID', 'ITEM_TYPE_ID', 'QUANTITY', 'ITEM_PRICE', 'ITEM_TYPE_SIZE'], 'required'],
            [['USER_ID', 'ITEM_TYPE_ID', 'QUANTITY', 'CART_TIMESTAMP'], 'integer'],
            [['ITEM_PRICE'], 'number'],
            [['CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['ITEM_TYPE_SIZE'], 'string', 'max' => 15],
            [['NOTES'], 'string', 'max' => 255],
            [['ITEM_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MenuItemType::className(), 'targetAttribute' => ['ITEM_TYPE_ID' => 'ITEM_TYPE_ID']],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['USER_ID' => 'USER_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMTYPE()
    {
        return $this->hasOne(MenuItemType::className(), ['ITEM_TYPE_ID' => 'ITEM_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(Users::className(), ['USER_ID' => 'USER_ID']);
    }
}
