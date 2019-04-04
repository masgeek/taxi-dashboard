<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "{{%make_years}}".
 *
 * @property integer $id
 * @property integer $year
 * @property integer $make_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 *
 * @property \common\models\Makes $make
 * @property \common\models\Models[] $models
 */
class MakeYears extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year'], 'required'],
            [['year', 'make_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['updated_by', 'created_by'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%make_years}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year of manufacture',
            'make_id' => 'Vehicle make',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMake()
    {
        return $this->hasOne(\common\models\Makes::className(), ['id' => 'make_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(\common\models\Models::className(), ['make_year_id' => 'id']);
    }
    }
