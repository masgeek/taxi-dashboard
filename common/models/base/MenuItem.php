<?php

namespace common\models\base;

/**
 * This is the model class for table "menu_item".
 *
 * @property int $MENU_ITEM_ID
 * @property int $MENU_CAT_ID
 * @property string $MENU_ITEM_NAME
 * @property string $MENU_ITEM_DESC
 * @property string $MENU_ITEM_IMAGE
 * @property bool $HOT_DEAL
 * @property bool $VEGETARIAN
 * @property int $MAX_QTY Show the maximum number of quantities one can select from
 * @property resource $IMAGE
 *
 * @property MenuCategory $mENUCAT
 * @property MenuItemType[] $menuItemTypes
 * @property Sizes[] $iTEMTYPESIZEs
 * @property Favs[] $favs
 */
class MenuItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MENU_CAT_ID', 'MENU_ITEM_NAME', 'MENU_ITEM_DESC', 'MENU_ITEM_IMAGE'], 'required'],
            [['MENU_CAT_ID', 'MAX_QTY'], 'integer'],
            [['MENU_ITEM_DESC', 'IMAGE'], 'string'],
            [['HOT_DEAL', 'VEGETARIAN'], 'boolean'],
            [['MENU_ITEM_NAME', 'MENU_ITEM_IMAGE'], 'string', 'max' => 255],
            [['MENU_CAT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MenuCategory::className(), 'targetAttribute' => ['MENU_CAT_ID' => 'MENU_CAT_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MENU_ITEM_ID' => 'M E N U I T E M I D',
            'MENU_CAT_ID' => 'M E N U C A T I D',
            'MENU_ITEM_NAME' => 'M E N U I T E M N A M E',
            'MENU_ITEM_DESC' => 'M E N U I T E M D E S C',
            'MENU_ITEM_IMAGE' => 'M E N U I T E M I M A G E',
            'HOT_DEAL' => 'H O T D E A L',
            'VEGETARIAN' => 'V E G E T A R I A N',
            'MAX_QTY' => 'Show the maximum number of quantities one can select from',
            'IMAGE' => 'I M A G E',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENUCAT()
    {
        return $this->hasOne(MenuCategory::className(), ['MENU_CAT_ID' => 'MENU_CAT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItemTypes()
    {
        return $this->hasMany(MenuItemType::className(), ['MENU_ITEM_ID' => 'MENU_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMTYPESIZEs()
    {
        return $this->hasMany(Sizes::className(), ['SIZE_TYPE' => 'ITEM_TYPE_SIZE'])->viaTable('menu_item_type', ['MENU_ITEM_ID' => 'MENU_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavs()
    {
        return $this->hasMany(Favs::className(), ['MENU_ITEM_ID' => 'MENU_ITEM_ID']);
    }
}
