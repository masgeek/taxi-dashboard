<?php

namespace common\models;

use common\models\base\UserType as BaseUserType;

/**
 * This is the model class for table "tb_user_type".
 */
class UserType extends BaseUserType
{
    public const USER_PASSENGER = 'PASSENGER';
    public const USER_DRIVER = 'DRIVER';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_type'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['user_type'], 'string', 'max' => 20],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 30],
            [['user_type'], 'unique'],
            [['slug'], 'unique']
        ]);
    }
	
}
