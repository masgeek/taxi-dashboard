<?php

namespace common\models;

use \common\models\base\MakeYears as BaseMakeYears;

/**
 * This is the model class for table "tb_make_years".
 */
class MakeYears extends BaseMakeYears
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['year'], 'required'],
            [['year', 'make_id'], 'integer']
        ]);
    }
	
}
