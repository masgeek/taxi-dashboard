<?php
/** @noinspection UndetectableTableInspection */

/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 4/4/2019
 * Time: 10:19 PM
 */

namespace common\extend;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

class BaseModel extends ActiveRecord
{
    /**
     * @inheritdoc
     * @return array mixed
     */
    public
    function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'created_by',
            ],
        ];
    }

}