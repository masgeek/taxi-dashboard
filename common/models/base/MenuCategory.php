<?php

namespace common\models\base;

/**
 * This is the model class for table "menu_category".
 *
 * @property int $MENU_CAT_ID
 * @property string $MENU_CAT_NAME
 * @property string $MENU_CAT_IMAGE
 * @property int $ACTIVE
 * @property int $RANK
 * @property resource $IMAGE
 *
 * @property MenuItem[] $menuItems
 */
class MenuCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MENU_CAT_NAME', 'RANK'], 'required'],
            [['ACTIVE', 'RANK'], 'integer'],
            [['IMAGE'], 'string'],
            [['MENU_CAT_NAME'], 'string', 'max' => 50],
            [['MENU_CAT_IMAGE'], 'string', 'max' => 255],
            [['MENU_CAT_NAME'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MENU_CAT_ID' => 'M E N U C A T I D',
            'MENU_CAT_NAME' => 'M E N U C A T N A M E',
            'MENU_CAT_IMAGE' => 'M E N U C A T I M A G E',
            'ACTIVE' => 'A C T I V E',
            'RANK' => 'R A N K',
            'IMAGE' => 'I M A G E',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItem::className(), ['MENU_CAT_ID' => 'MENU_CAT_ID']);
    }
}
