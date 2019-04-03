<?php

namespace common\models;

use \common\models\base\AssignedVehicles as BaseAssignedVehicles;

/**
 * This is the model class for table "tb_assigned_vehicles".
 */
class AssignedVehicles extends BaseAssignedVehicles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['driver_id', 'vehicle_id', 'date_assigned'], 'required'],
            [['driver_id', 'vehicle_id'], 'integer'],
            [['date_assigned', 'date_unassigned', 'created_at', 'updated_at'], 'safe'],
            [['active'], 'string', 'max' => 1],
            [['driver_id', 'vehicle_id', 'date_assigned'], 'unique', 'targetAttribute' => ['driver_id', 'vehicle_id', 'date_assigned'], 'message' => 'The combination of Driver ID, Vehicle ID and Date Assigned has already been taken.']
        ]);
    }
	
}
