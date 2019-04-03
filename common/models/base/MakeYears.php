<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%make_years}}".
 *
 * @property int $id
 * @property int $year Year of manufacture
 * @property int $make_id Vehicle make
 *
 * @property Makes $make
 * @property Models[] $models
 */
class MakeYears extends \yii\db\ActiveRecord
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
