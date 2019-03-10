<?php

namespace common\models;

use Yii;
use \common\models\base\AuthorizationCodes as BaseAuthorizationCodes;

/**
 * This is the model class for table "authorization_codes".
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
                [['code', 'expires_at', 'user_id', 'created_at', 'updated_at'], 'required'],
                [['expires_at', 'user_id', 'created_at', 'updated_at'], 'integer'],
                [['code'], 'string', 'max' => 150],
                [['app_id'], 'string', 'max' => 200]
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'expires_at' => 'Expires At',
            'user_id' => 'User ID',
            'app_id' => 'App ID',
        ];
    }

    public static function isValid($code)
    {
        $model = static::findOne(['code' => $code]);

        if (!$model || $model->expires_at < time()) {
            Yii::$app->api->sendFailedResponse("Authcode Expired");
            return (false);
        }

        return ($model);
    }
}
