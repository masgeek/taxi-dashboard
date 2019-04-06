<?php

namespace common\models;

use common\helper\APP_UTILS;
use common\models\base\ApiToken as BaseApiToken;

/**
 * This is the model class for table "api_token".
 */
class ApiToken extends BaseApiToken
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['USER_ID'], 'integer'],
                [['DATE_CREATED', 'EXPIRY_DATE'], 'safe'],
                [['API_TOKEN'], 'string', 'max' => 255]
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'TOKEN_ID' => 'T O K E N I D',
            'USER_ID' => 'U S E R I D',
            'API_TOKEN' => 'A P I T O K E N',
            'DATE_CREATED' => 'D A T E C R E A T E D',
            'EXPIRY_DATE' => 'E X P I R Y D A T E',
        ];
    }

    /**
     * @param $user_id
     * @return string|null
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public static function CreateApiToken($user_id)
    {
        //let us check if it exists
        $token = self::findOne(['USER_ID' => $user_id]);
        if ($token == null) {
            //create new record  if it does not  exists
            $token = new self();
            $token->USER_ID = $user_id;
        }
        $token->API_TOKEN = APP_UTILS::GenerateToken();
        $token->DATE_CREATED = APP_UTILS::GetCurrentDateTime();
        $token->EXPIRY_DATE = APP_UTILS::GetFutureDateTime();

        if ($token->save()) {
            return $token->API_TOKEN;
        }
        return null;
    }

    /**
     * @param $api_token
     * @param $user_id
     * @return bool
     */
    public static function IsValidToken($api_token, $user_id)
    {
        $token = self::findOne(['API_TOKEN' => $api_token, 'USER_ID' => $user_id]);
        return $token != null ? true : false;
    }
}
