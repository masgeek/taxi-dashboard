<?php

namespace common\models;

use common\models\base\Trips as BaseTrips;

/**
 * This is the model class for table "tb_trips".
 */
class Trips extends BaseTrips
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['client_id', 'assigned_vehicle_id', 'origin', 'destination', 'start_date', 'end_date', 'status'], 'required'],
            [['client_id', 'assigned_vehicle_id'], 'integer'],
            [['origin', 'destination', 'map_image'], 'string'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['distance_covered', 'total_cost'], 'number'],
            [['status', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['invoice_generated'], 'string', 'max' => 1]
        ]);
    }
	
}
