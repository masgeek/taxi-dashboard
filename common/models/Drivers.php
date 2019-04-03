<?php

namespace common\models;

use \common\models\base\Drivers as BaseDrivers;

/**
 * This is the model class for table "tb_drivers".
 */
class Drivers extends BaseDrivers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['driver_id'], 'required'],
            [['driver_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['active'], 'string', 'max' => 1]
        ]);
    }
	
}
