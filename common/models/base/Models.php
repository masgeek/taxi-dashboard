<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%models}}".
 *
 * @property int $id
 * @property string $name Vehicle name
 * @property int $make_year_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property MakeYears $makeYear
 * @property Vehicles[] $vehicles
 */
class Models extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%models}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'make_year_id'], 'required'],
            [['make_year_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['name', 'make_year_id'], 'unique', 'targetAttribute' => ['name', 'make_year_id']],
            [['make_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => MakeYears::className(), 'targetAttribute' => ['make_year_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Vehicle name',
            'make_year_id' => 'Make Year ID',
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
    public function getMakeYear()
    {
        return $this->hasOne(MakeYears::className(), ['id' => 'make_year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicles::className(), ['model_id' => 'id']);
    }
}
