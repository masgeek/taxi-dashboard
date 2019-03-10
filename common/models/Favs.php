<?php

namespace common\models;

use \common\models\base\Favs as BaseFavs;

/**
 * This is the model class for table "tb_favs".
 */
class Favs extends BaseFavs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['MENU_ITEM_ID', 'USER_ID'], 'integer']
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'FAV_ID' => 'F A V I D',
            'MENU_ITEM_ID' => 'M E N U I T E M I D',
            'USER_ID' => 'U S E R I D',
        ];
    }
}
