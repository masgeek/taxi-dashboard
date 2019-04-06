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
}
