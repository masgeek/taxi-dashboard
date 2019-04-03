<?php

namespace common\models;

use \common\models\base\Models as BaseModels;

/**
 * This is the model class for table "tb_models".
 */
class Models extends BaseModels
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'make_year_id'], 'required'],
            [['make_year_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name', 'make_year_id'], 'unique', 'targetAttribute' => ['name', 'make_year_id'], 'message' => 'The combination of Vehicle name and Make Year ID has already been taken.']
        ]);
    }
	
}
