<?php

namespace common\models;

use \common\models\base\Vehicles as BaseVehicles;

/**
 * This is the model class for table "tb_vehicles".
 */
class Vehicles extends BaseVehicles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['model_id', 'capacity', 'color'], 'integer'],
            [['mileage', 'total_distance'], 'number'],
            [['reg_no', 'reg_year'], 'required'],
            [['reg_year', 'created_at', 'updated_at'], 'safe'],
            [['reg_no'], 'string', 'max' => 10],
            [['active'], 'string', 'max' => 1],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['reg_no'], 'unique']
        ]);
    }
	
}
