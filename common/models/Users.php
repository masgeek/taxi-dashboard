<?php

namespace common\models;

use common\models\base\Users as BaseUsers;

/**
 * This is the model class for table "tb_users".
 */
class Users extends BaseUsers
{

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

        return $rules;
    }

    public function requestMapper()
    {

    }
}
