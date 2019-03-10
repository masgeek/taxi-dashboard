<?php

namespace common\models;

use \common\models\base\UserType as BaseUserType;

/**
 * This is the model class for table "user_type".
 */
class UserType extends BaseUserType
{
    /**
     * @param array $excludeList
     * @return array
     */
    public static function GetUserTypes(array $excludeList = ['ADMIN', 'RIDER'])
    {
        $userType = self::find()
            ->where(['NOT IN', 'USER_TYPE_NAME', $excludeList])
            ->all();

        $userTypeArr = [];
        foreach ($userType as $key => $user_type_model) {
            $userTypeArr[$user_type_model->USER_TYPE_ID] = $user_type_model->USER_TYPE_NAME;
        }

        return $userTypeArr;
    }
}
