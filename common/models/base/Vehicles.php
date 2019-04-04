<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "{{%vehicles}}".
 *
 * @property integer $id
 * @property integer $model_id
 * @property integer $capacity
 * @property integer $color
 * @property double $mileage
 * @property double $total_distance
 * @property string $reg_no
 * @property string $reg_year
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 *
 * @property \common\models\AssignedVehicles[] $assignedVehicles
 * @property \common\models\Models $model
 */
class Vehicles extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id', 'capacity', 'color'], 'integer'],
            [['mileage', 'total_distance'], 'number'],
            [['reg_no', 'reg_year'], 'required'],
            [['reg_year', 'created_at', 'updated_at'], 'safe'],
            [['reg_no'], 'string', 'max' => 10],
            [['active'], 'string', 'max' => 1],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['reg_no'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vehicles}}';
    }

    /**
     * @inheritdoc
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
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedVehicles()
    {
        return $this->hasMany(\common\models\AssignedVehicles::className(), ['vehicle_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(\common\models\Models::className(), ['id' => 'model_id']);
    }
    }
