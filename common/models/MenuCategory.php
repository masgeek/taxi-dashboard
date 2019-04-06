<?php

namespace common\models;

use common\models\base\MenuCategory as BaseMenuCategory;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_category".
 */
class MenuCategory extends BaseMenuCategory
{

    public $IMAGE_FILE;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['MENU_CAT_NAME'], 'unique'];
        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'MENU_CAT_ID' => Yii::t('app', 'Menu  Cat  ID'),
            'MENU_CAT_NAME' => Yii::t('app', 'Category Name'),
            'MENU_CAT_IMAGE' => Yii::t('app', 'Category Image'),
            'ACTIVE' => Yii::t('app', 'Active'),
            'RANK' => Yii::t('app', 'Rank'),
        ];
    }


    public static function GetMenuCategories($textSearch = false)
    {

        $menuCategories = self::find()
            //->where(['KITCHEN_ID' => $kitchen_id])
            ->where(['ACTIVE' => 1])
            ->all();


        $listData = $textSearch ? ArrayHelper::map($menuCategories, 'MENU_CAT_NAME', 'MENU_CAT_NAME') : ArrayHelper::map($menuCategories, 'MENU_CAT_ID', 'MENU_CAT_NAME');

        return $listData;
    }

}
