<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "{{%users}}".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $user_type
 * @property integer $account_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\AccessTokens[] $accessTokens
 * @property \common\models\AuthorizationCodes[] $authorizationCodes
 * @property \common\models\UserType $userType
 */
class Users extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'user_type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'user_type'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 300],
            [['account_active'], 'string', 'max' => 1],
            [['username'], 'unique'],
            [['password'], 'unique']
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
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'user_type' => 'User TYpe',
            'account_active' => 'Account Active',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessTokens()
    {
        return $this->hasMany(\common\models\AccessTokens::className(), ['user_id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorizationCodes()
    {
        return $this->hasMany(\common\models\AuthorizationCodes::className(), ['user_id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(\common\models\UserType::className(), ['user_type' => 'user_type']);
    }
    }
