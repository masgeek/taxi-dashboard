<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%assigned_vehicles}}".
 *
 * @property integer $id
 * @property integer $driver_id
 * @property integer $vehicle_id
 * @property string $date_assigned
 * @property string $date_unassigned
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property \common\models\Drivers $driver
 * @property \common\models\Vehicles $vehicle
 * @property \common\models\Trips[] $trips
 */
class AssignedVehicles extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'vehicle_id', 'date_assigned'], 'required'],
            [['driver_id', 'vehicle_id'], 'integer'],
            [['date_assigned', 'date_unassigned', 'created_at', 'updated_at'], 'safe'],
            [['active'], 'string', 'max' => 1],
            [['updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['driver_id', 'vehicle_id', 'date_assigned'], 'unique', 'targetAttribute' => ['driver_id', 'vehicle_id', 'date_assigned'], 'message' => 'The combination of Driver ID, Vehicle ID and Date Assigned has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%assigned_vehicles}}';
    }

    /**
     * @inheritdoc
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
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(\common\models\Drivers::className(), ['id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(\common\models\Vehicles::className(), ['id' => 'vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(\common\models\Trips::className(), ['assigned_vehicle_id' => 'id']);
    }
}
