<?php

namespace common\models;

use common\models\base\Country as BaseCountry;

/**
 * This is the model class for table "country".
 */
class Country extends BaseCountry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['COUNTRY_NAME'], 'required'],
            [['COUNTRY_NAME'], 'string', 'max' => 100]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'COUNRY_ID' => 'C O U N R Y I D',
            'COUNTRY_NAME' => 'C O U N T R Y N A M E',
        ];
    }
}
