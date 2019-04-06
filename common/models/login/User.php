<?php

namespace common\models\login;


use common\models\AccessTokens;
use common\models\Users as BaseUser;
use Yii;
use yii\base\Exception;
use yii\base\Security;
use yii\web\IdentityInterface;

class User extends BaseUser implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const ROLE_USER = 10;

    public $ACCOUNT_AUTH_KEY;
    public $PASSWORD_RESET_TOKEN;
    public $CONFIRM_PASSWORD;
    public $FULL_NAMES;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        return $rules;
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     *                       Null should be returned if such an identity cannot be found
     *                       or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $access_token = AccessTokens::findOne(['token' => $token]);
        if ($access_token) {
            if ($access_token->expires_at < time()) {
                return Yii::$app->api->sendFailedResponse('Access token expired');
            }

            return static::findOne(['id' => $access_token->user_id]);
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function getAuthKey()
    {
        return null;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {
        /* @var $userModel $this */

        $account_found = null;

        $userModel = self::find()
            ->select(['id', 'username'])//select only specific fields
            ->where(['username' => $username])
            ->one();

        if ($userModel != null) {
            $account_found = static::findOne(['id' => $userModel->id]);
        }
        return $account_found;
    }


    /**
     * Password validation during login
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    /**
     * @param $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password = (new Security)->generatePasswordHash($password);
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Generates a password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = null;
    }

    //fields to return common stuff
    public function getUsername()
    {
        return $this->username;
    }
}
