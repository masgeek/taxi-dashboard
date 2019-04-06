<?php

namespace common\models\login;


use common\helper\APP_UTILS;
use common\models\AccessTokens;
use common\models\Users as BaseUser;
use Yii;
use yii\base\Security;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $USER_ID
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $authKey
 * @property string $password write-only password
 */
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
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

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

            return static::findOne(['USER_ID' => $access_token->user_id]);
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
        //$userModel = UserProfile::findOne(['USER_NAME' => $username, 'EMAIL_ADDRESS'=>$username]);
        $userModel = self::find()
            ->select(['USER_ID', 'EMAIL'])//select only specific fields
            ->where(['EMAIL' => $username])
            ->one();
        if ($userModel == null) {
            $userModel = self::find()
                ->select(['USER_ID', 'EMAIL'])//select only specific fields
                ->where(['USER_NAME' => $username])
                ->one();
        }
        if ($userModel != null) {
            $account_found = static::findOne(['USER_ID' => $userModel->USER_ID]);
        }
        return $account_found;
    }

    public static function findByEmail($email)
    {
        /* @var $userModel $this */

        $account_found = null;
        //$userModel = UserProfile::findOne(['USER_NAME' => $username, 'EMAIL_ADDRESS'=>$username]);
        $userModel = self::find()
            ->select(['USER_ID', 'EMAIL'])//select only specific fields
            ->where(['EMAIL' => $email])
            ->one();

        if ($userModel != null) {
            $account_found = static::findOne(['USER_ID' => $userModel->USER_ID]);
        }
        return $account_found;
    }

    public static function findByToken($token)
    {
        /* @var $userModel $this */
        $account_found = null;
        $userModel = self::find()
            ->select(['USER_ID', 'EMAIL'])//select only specific fields
            ->where(['RESET_TOKEN' => $token])
            ->one();

        if ($userModel != null) {
            $account_found = static::findOne(['USER_ID' => $userModel->USER_ID]);
        }
        return $account_found;
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $date = APP_UTILS::GetCurrentDateTime();
            if ($this->isNewRecord) {
                $this->DATE_REGISTERED = $date;
            }
            $this->LAST_UPDATED = $date;
            return true;
        }
        return false;
    }

    /**
     * Password validation during login
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->PASSWORD === sha1($password);
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->PASSWORD = Security::generatePasswordHash($password);
    }

    public function getPassword()
    {
        return $this->PASSWORD;
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
        return $this->USER_NAME;
    }

    public function getFullName()
    {
        return "John Doe";
    }

    public function getEmailAddress()
    {
        return $this->EMAIL;
    }

    public function getMobile()
    {
        return $this->MOBILE;
    }
}
