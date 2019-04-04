<?php

namespace common\models;

use \common\models\base\UserClient as BaseUserClient;

/**
 * This is the model class for table "tb_user_client".
 */
class UserClient extends BaseUserClient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'client_id'], 'required'],
            [['user_id', 'client_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['updated_by', 'created_by'], 'string', 'max' => 255]
        ]);
    }
	
}
