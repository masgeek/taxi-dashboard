<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%access_tokens}}".
 *
 * @property integer $id
 * @property string $token
 * @property string $auth_code
 * @property integer $user_id
 * @property string $app_id
 * @property integer $expires_at
 * @property string $updated_by
 * @property string $created_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Users $user
 */
class AccessTokens extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'auth_code', 'app_id', 'expires_at'], 'required'],
            [['user_id', 'expires_at', 'created_at', 'updated_at'], 'integer'],
            [['token'], 'string', 'max' => 300],
            [['auth_code', 'app_id'], 'string', 'max' => 200],
            [['updated_by', 'created_by'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%access_tokens}}';
    }

    /**
     * @inheritdoc
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\Users::className(), ['id' => 'user_id']);
    }
}
