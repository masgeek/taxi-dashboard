<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%assigned_vehicles}}".
 *
 * @property int $id
 * @property int $driver_id
 * @property int $vehicle_id
 * @property string $date_assigned
 * @property string $date_unassigned
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Drivers $driver
 * @property Vehicles $vehicle
 */
class AssignedVehicles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assigned_vehicles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['driver_id', 'vehicle_id', 'date_assigned'], 'required'],
            [['driver_id', 'vehicle_id', 'active'], 'integer'],
            [['date_assigned', 'date_unassigned', 'created_at', 'updated_at'], 'safe'],
            [['driver_id', 'vehicle_id', 'date_assigned'], 'unique', 'targetAttribute' => ['driver_id', 'vehicle_id', 'date_assigned']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Drivers::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicles::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
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
            'vehicle_id' => 'Vehicle ID',
            'date_assigned' => 'Date Assigned',
            'date_unassigned' => 'Date Unassigned',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Drivers::className(), ['id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicles::className(), ['id' => 'vehicle_id']);
    }
}
