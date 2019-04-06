<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%trips}}".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $assigned_vehicle_id
 * @property string $origin
 * @property string $destination
 * @property string $start_date
 * @property string $end_date
 * @property string $status
 * @property double $distance_covered
 * @property double $total_cost
 * @property integer $invoice_generated
 * @property resource $map_image
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property \common\models\TripInvoiceItems[] $tripInvoiceItems
 * @property \common\models\Clients $client
 * @property \common\models\AssignedVehicles $assignedVehicle
 */
class Trips extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'assigned_vehicle_id', 'origin', 'destination', 'start_date', 'end_date', 'status'], 'required'],
            [['client_id', 'assigned_vehicle_id'], 'integer'],
            [['origin', 'destination', 'map_image'], 'string'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['distance_covered', 'total_cost'], 'number'],
            [['status', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['invoice_generated'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%trips}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'assigned_vehicle_id' => 'Assigned Vehicle ID',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'distance_covered' => 'Distance Covered',
            'total_cost' => 'Total Cost',
            'invoice_generated' => 'Invoice Generated',
            'map_image' => 'Map Image',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTripInvoiceItems()
    {
        return $this->hasMany(\common\models\TripInvoiceItems::className(), ['trip_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(\common\models\Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedVehicle()
    {
        return $this->hasOne(\common\models\AssignedVehicles::className(), ['id' => 'assigned_vehicle_id']);
    }
}
