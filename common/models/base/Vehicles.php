<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%vehicles}}".
 *
 * @property int $id
 * @property int $model_id
 * @property int $capacity Sitting capacity
 * @property int $color Vehicle color
 * @property double $mileage Mileage
 * @property double $total_distance Total distance covered
 * @property string $reg_no Registration
 * @property string $reg_year Registration year
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property AssignedVehicles[] $assignedVehicles
 * @property Models $model
 */
class Vehicles extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vehicles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_id', 'capacity', 'color', 'active'], 'integer'],
            [['mileage', 'total_distance'], 'number'],
            [['reg_no', 'reg_year'], 'required'],
            [['reg_year', 'created_at', 'updated_at'], 'safe'],
            [['reg_no'], 'string', 'max' => 10],
            [['updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['reg_no'], 'unique'],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Models::className(), 'targetAttribute' => ['model_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'capacity' => 'Sitting capacity',
            'color' => 'Vehicle color',
            'mileage' => 'Mileage',
            'total_distance' => 'Total distance covered',
            'reg_no' => 'Registration',
            'reg_year' => 'Registration year',
            'active' => 'Active',
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
    public function getAssignedVehicles()
    {
        return $this->hasMany(AssignedVehicles::className(), ['vehicle_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Models::className(), ['id' => 'model_id']);
    }
}
