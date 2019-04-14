<?php


namespace api\models\definitions;

/**
 * @SWG\Definition(required={"username","email","password","usertype"})
 *
 * @SWG\Property(property="username", type="string")
 * @SWG\Property(property="email", type="string")
 * @SWG\Property(property="password", type="string")
 * @SWG\Property(property="usertype", type="string")
 */
class Users extends \common\models\Users
{

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['password']); //remove sensitive fields

        return $fields;
    }
}