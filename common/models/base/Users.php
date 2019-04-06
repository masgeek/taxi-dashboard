<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%users}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $user_type
 * @property integer $account_active
 * @property string $updated_by
 * @property string $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $email
 *
 * @property \common\models\AccessTokens[] $accessTokens
 * @property \common\models\AuthorizationCodes[] $authorizationCodes
 * @property \common\models\UserClient[] $userClients
 * @property \common\models\UserType $userType
 */
class Users extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'user_type', 'email'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'user_type'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 300],
            [['account_active'], 'string', 'max' => 1],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['password'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'user_type' => 'User Type',
            'account_active' => 'Account Active',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessTokens()
    {
        return $this->hasMany(\common\models\AccessTokens::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorizationCodes()
    {
        return $this->hasMany(\common\models\AuthorizationCodes::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClients()
    {
        return $this->hasMany(\common\models\UserClient::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(\common\models\UserType::className(), ['user_type' => 'user_type']);
    }
}
