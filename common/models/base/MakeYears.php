<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%make_years}}".
 *
 * @property int $id
 * @property int $year Year of manufacture
 * @property int $make_id Vehicle make
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property Makes $make
 * @property Models[] $models
 */
class MakeYears extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%make_years}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year'], 'required'],
            [['year', 'make_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Makes::className(), 'targetAttribute' => ['make_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year of manufacture',
            'make_id' => 'Vehicle make',
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
    public function getMake()
    {
        return $this->hasOne(Makes::className(), ['id' => 'make_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(Models::className(), ['make_year_id' => 'id']);
    }
}
