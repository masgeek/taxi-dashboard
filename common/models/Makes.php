<?php

namespace common\models;

use common\models\base\Makes as BaseMakes;

/**
 * This is the model class for table "tb_makes".
 *
 */
class Makes extends BaseMakes
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['slug']['attribute'] = 'name';

        return $behaviors;
    }

    public static function findByBySlug($slug)
    {
        $data = self::find()->where([
                'slug' => strtolower($slug)]
        );
        return $data;
    }

}
