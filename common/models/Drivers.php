<?php

namespace common\models;

use common\models\base\Drivers as BaseDrivers;

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
            [['username', 'email', 'mobile', 'password'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 20],
            [['active'], 'string', 'max' => 1],
            [['password', 'updated_by', 'created_by'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['mobile'], 'unique']
        ]);
    }
	
}
