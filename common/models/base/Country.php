<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $COUNRY_ID
 * @property string $COUNTRY_NAME
 *
 * @property City[] $cities
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['COUNTRY_NAME'], 'required'],
            [['COUNTRY_NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'COUNRY_ID' => 'C O U N R Y I D',
            'COUNTRY_NAME' => 'C O U N T R Y N A M E',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['COUNTRY_ID' => 'COUNRY_ID']);
    }
}
