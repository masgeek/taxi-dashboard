<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 09-Oct-17
 * Time: 15:16
 */

namespace app\api\modules\v1\models;


use app\helpers\APP_UTILS;
use app\models\MenuCategory;

class MENU_CAT_MODEL extends MenuCategory
{
    public function fields()
    {
        $fields = parent::fields(); // TODO: Change the autogenerated stub

        $fields['MENU_CAT_IMAGE'] = function ($model) {
            /* @var $model self */
            return APP_UTILS::BuildImageUrl($model->MENU_CAT_IMAGE);
        };

        return $fields;
    }
}