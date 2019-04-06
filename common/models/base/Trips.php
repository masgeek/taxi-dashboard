<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%trips}}".
 *
 * @property int $id
 * @property int $client_id
 * @property int $assigned_vehicle_id
 * @property string $origin
 * @property string $destination
 * @property string $start_date
 * @property string $end_date
 * @property string $status
 * @property double $distance_covered
 * @property double $total_cost
 * @property int $invoice_generated
 * @property resource $map_image
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property TripInvoiceItems[] $tripInvoiceItems
 * @property Clients $client
 * @property AssignedVehicles $assignedVehicle
 */
class Trips extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%trips}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'assigned_vehicle_id', 'origin', 'destination', 'start_date', 'end_date', 'status'], 'required'],
            [['client_id', 'assigned_vehicle_id', 'invoice_generated'], 'integer'],
            [['origin', 'destination', 'map_image'], 'string'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['distance_covered', 'total_cost'], 'number'],
            [['status', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['assigned_vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssignedVehicles::className(), 'targetAttribute' => ['assigned_vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTripInvoiceItems()
    {
        return $this->hasMany(TripInvoiceItems::className(), ['trip_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedVehicle()
    {
        return $this->hasOne(AssignedVehicles::className(), ['id' => 'assigned_vehicle_id']);
    }
}
