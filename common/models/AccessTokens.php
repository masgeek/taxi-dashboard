<?php

namespace common\models;

use \common\models\base\AccessTokens as BaseAccessTokens;

/**
 * This is the model class for table "access_tokens".
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
            [['token', 'expires_at', 'auth_code', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['expires_at', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['token'], 'string', 'max' => 300],
            [['auth_code', 'app_id'], 'string', 'max' => 200]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'expires_at' => 'Expires At',
            'auth_code' => 'Auth Code',
            'user_id' => 'User ID',
            'app_id' => 'App ID',
        ];
    }
}
