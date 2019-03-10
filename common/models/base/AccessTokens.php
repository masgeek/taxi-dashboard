<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%access_tokens}}".
 *
 * @property int $id
 * @property string $token
 * @property string $auth_code
 * @property int $user_id
 * @property string $app_id
 * @property int $expires_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $user
 */
class AccessTokens extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%access_tokens}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token', 'auth_code', 'app_id', 'expires_at'], 'required'],
            [['user_id', 'expires_at'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['token'], 'string', 'max' => 300],
            [['auth_code', 'app_id'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'USER_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'auth_code' => 'Auth Code',
            'user_id' => 'User ID',
            'app_id' => 'App ID',
            'expires_at' => 'Expires At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['USER_ID' => 'user_id']);
    }
}
