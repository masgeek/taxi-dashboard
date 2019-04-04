<?php

namespace common\models;

use \common\models\base\AuthorizationCodes as BaseAuthorizationCodes;

/**
 * This is the model class for table "tb_authorization_codes".
 */
class AuthorizationCodes extends BaseAuthorizationCodes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['code', 'app_id', 'expires_at'], 'required'],
            [['user_id', 'expires_at'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 150],
            [['app_id'], 'string', 'max' => 200],
            [['updated_by', 'created_by'], 'string', 'max' => 255]
        ]);
    }
	
}
