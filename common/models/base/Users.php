<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $username Username
 * @property string $password
 * @property string $user_type User Type
 * @property int $account_active Account Active
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 *
 * @property AccessTokens[] $accessTokens
 * @property AuthorizationCodes[] $authorizationCodes
 * @property UserClient[] $userClients
 * @property UserType $userType
 */
class Users extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'user_type'], 'required'],
            [['account_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'user_type'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 300],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['password'], 'unique'],
            [['user_type'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type' => 'user_type']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'user_type' => 'User Type',
            'account_active' => 'Account Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessTokens()
    {
        return $this->hasMany(AccessTokens::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorizationCodes()
    {
        return $this->hasMany(AuthorizationCodes::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClients()
    {
        return $this->hasMany(UserClient::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['user_type' => 'user_type']);
    }
}
