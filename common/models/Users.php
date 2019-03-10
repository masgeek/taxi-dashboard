<?php

namespace common\models;

use \common\models\base\Users as BaseUsers;

/**
 * This is the model class for table "tb_users".
 */
class Users extends BaseUsers
{
    public $reCaptcha;
    public $status;

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::class];

        return $rules;
    }

    public function getUserType()
    {
        return UserType::findOne($this->USER_TYPE)->USER_TYPE_NAME;
    }
}
