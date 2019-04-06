<?php

namespace common\models;

use common\models\base\Chef as BaseChef;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "chef".
 */
class Chef extends BaseChef
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['CHEF_NAME', 'KITCHEN_ID'], 'required'],
                [['KITCHEN_ID'], 'integer'],
                [['CHEF_NAME'], 'string', 'max' => 100]
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return $this->attributeLabels();
    }

    public static function GetChefs($kitchen_id, $asModel = false)
    {
        $chefs = self::find()
            ->where(['KITCHEN_ID' => $kitchen_id])
            ->all();

        $listData = ArrayHelper::map($chefs, 'CHEF_ID', 'CHEF_NAME');

        return $asModel ? $chefs : $listData;
    }

    public static function GetAllChefs()
    {
        $kitchen = self::find()
            ->all();
        $listData = ArrayHelper::map($kitchen, 'CHEF_ID', 'CHEF_NAME');

        return $listData;
    }

    /**
     * @return int|string
     */
    public static function GetChefCount()
    {
        $chefs = self::find()->count();
        return $chefs < 8 ? 8 : $chefs;
    }
}
