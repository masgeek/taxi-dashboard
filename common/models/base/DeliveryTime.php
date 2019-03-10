<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%delivery_time}}".
 *
 * @property int $TIME_ID
 * @property string $DELIVERY_TIME
 */
class DeliveryTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%delivery_time}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DELIVERY_TIME'], 'required'],
            [['DELIVERY_TIME'], 'string', 'max' => 20],
            [['DELIVERY_TIME'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TIME_ID' => 'T I M E I D',
            'DELIVERY_TIME' => 'D E L I V E R Y T I M E',
        ];
    }
}
