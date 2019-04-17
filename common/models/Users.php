<?php

namespace common\models;

use common\components\PasswordValidator;
use common\models\base\Users as BaseUsers;

/**
 * This is the model class for table "tb_users".
 */
class Users extends BaseUsers
{

    public $confirm_password;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        unset($behaviors['slug']);

        return $behaviors;
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        $rules = parent::rules();

        //$rules[] = ['user_type', 'each', 'rule' => ['in', 'allowArray' => false, 'range' => [2, 4, 6, 8]]];
        $rules[] = ['email', 'email'];
        $rules[] = ['user_type', 'in', 'allowArray' => true, 'range' => [UserType::USER_PASSENGER, UserType::USER_DRIVER], 'message' => 'Invalid user type'];

        $rules[] = [['password'], PasswordValidator::class, 'preset' => PasswordValidator::SIMPLE, 'userAttribute' => 'username'];
        $rules[] = ['confirm_password', 'compare', 'compareAttribute' => 'password'];
        return $rules;
    }

    public function registerUser()
    {

        $this->setPassword($this->password);
        $this->generateAuthKey();

        return false;
        if ($this->validate()) {
            if ($this->save()) {
                return true;
            }
        }
        return false;
    }
}
