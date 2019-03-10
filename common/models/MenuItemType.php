<?php

namespace common\models;

use Yii;
use \common\models\base\MenuItemType as BaseMenuItemType;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_item_type".
 */
class MenuItemType extends BaseMenuItemType
{
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['AVAILABLE'], 'boolean'];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_TYPE_ID' => Yii::t('app', 'Item  Type  ID'),
            'MENU_ITEM_ID' => Yii::t('app', 'Menu  Item  ID'),
            'ITEM_TYPE_SIZE' => Yii::t('app', 'Item  Type  Size'),
            'PRICE' => Yii::t('app', 'Price'),
            'AVAILABLE' => Yii::t('app', 'Available'),
        ];
    }

    public static function getMenuItems()
    {
        $menuItem = self::find()->all();

        $listData = ArrayHelper::map($menuItem, 'ITEM_TYPE_SIZE', 'ITEM_TYPE_SIZE');

        return $listData;
    }
}
