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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name'], 'required'],
                [['created_at', 'updated_at'], 'safe'],
                [['name', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
                [['name'], 'unique']
            ]);
    }

    public static function findByBySlug($slug)
    {
        $data = self::find()->where([
                'slug' => strtolower($slug)]
        );
        return $data;
    }

}
