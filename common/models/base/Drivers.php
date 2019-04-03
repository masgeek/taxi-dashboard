<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%drivers}}".
 *
 * @property int $id
 * @property int $driver_id
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AssignedVehicles[] $assignedVehicles
 * @property Users $driver
 */
class Drivers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%drivers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['driver_id'], 'required'],
            [['driver_id', 'active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['driver_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => 'Driver ID',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedVehicles()
    {
        return $this->hasMany(AssignedVehicles::className(), ['driver_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Users::className(), ['id' => 'driver_id']);
    }
}
