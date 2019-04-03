<?php

namespace common\models;

use \common\models\base\Makes as BaseMakes;

/**
 * This is the model class for table "tb_makes".
 */
class Makes extends BaseMakes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique']
        ]);
    }
	
}
