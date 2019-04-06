<?php

namespace common\models;

use common\models\base\AccessTokens as BaseAccessTokens;

/**
 * This is the model class for table "tb_access_tokens".
 */
class AccessTokens extends BaseAccessTokens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['token', 'auth_code', 'app_id', 'expires_at'], 'required'],
            [['user_id', 'expires_at', 'created_at', 'updated_at'], 'integer'],
            [['token'], 'string', 'max' => 300],
            [['auth_code', 'app_id'], 'string', 'max' => 200],
            [['updated_by', 'created_by'], 'string', 'max' => 255]
        ]);
    }
	
}
