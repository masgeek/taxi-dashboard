<?php

namespace common\models;

use \common\models\base\MySession as BaseMySession;

/**
 * This is the model class for table "my_session".
 */
class MySession extends BaseMySession
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id'], 'required'],
            [['expire', 'user_id'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 60],
            [['user_name'], 'string', 'max' => 20]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => 'ID',
            'expire' => 'Expire',
            'data' => 'Data',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
        ];
    }
}
