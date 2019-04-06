<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%models}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $make_year_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property \common\models\MakeYears $makeYear
 * @property \common\models\Vehicles[] $vehicles
 */
class Models extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'make_year_id'], 'required'],
            [['make_year_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['name', 'make_year_id'], 'unique', 'targetAttribute' => ['name', 'make_year_id'], 'message' => 'The combination of Vehicle name and Make Year ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%models}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Vehicle name',
            'make_year_id' => 'Make Year ID',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeYear()
    {
        return $this->hasOne(\common\models\MakeYears::className(), ['id' => 'make_year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(\common\models\Vehicles::className(), ['model_id' => 'id']);
    }
}
