<?php

namespace common\models\base;

use Yii;

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
 *
 * @property AccessTokens[] $accessTokens
 * @property AuthorizationCodes[] $authorizationCodes
 * @property Drivers[] $drivers
 * @property UserType $userType
 */
class Users extends \yii\db\ActiveRecord
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
    public function getDrivers()
    {
        return $this->hasMany(Drivers::className(), ['driver_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['user_type' => 'user_type']);
    }
}
