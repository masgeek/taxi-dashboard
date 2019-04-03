<?php

namespace common\models;

use \common\models\base\Users as BaseUsers;

/**
 * This is the model class for table "tb_users".
 */
class Users extends BaseUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['username', 'password', 'user_type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'user_type'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 300],
            [['account_active'], 'string', 'max' => 1],
            [['username'], 'unique'],
            [['password'], 'unique']
        ]);
    }
	
}
