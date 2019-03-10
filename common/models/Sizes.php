<?php

namespace common\models;

use Yii;
use \common\models\base\Sizes as BaseSizes;

/**
 * This is the model class for table "tb_sizes".
 */
class Sizes extends BaseSizes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['SIZE_TYPE'], 'unique'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SIZE_ID' => Yii::t('app', 'Size  ID'),
            'SIZE_TYPE' => Yii::t('app', 'Size  Type'),
            'ACTIVE' => Yii::t('app', 'Active'),
        ];
    }
}
