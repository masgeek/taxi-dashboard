<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $CITY_ID
 * @property string $CITY_NAME
 * @property int $COUNTRY_ID
 *
 * @property Country $cOUNTRY
 * @property Kitchen[] $kitchens
 * @property Location[] $locations
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CITY_NAME', 'COUNTRY_ID'], 'required'],
            [['COUNTRY_ID'], 'integer'],
            [['CITY_NAME'], 'string', 'max' => 100],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNRY_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CITY_ID' => 'C I T Y I D',
            'CITY_NAME' => 'C I T Y N A M E',
            'COUNTRY_ID' => 'C O U N T R Y I D',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Country::className(), ['COUNRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKitchens()
    {
        return $this->hasMany(Kitchen::className(), ['CITY_ID' => 'CITY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['CITY_ID' => 'CITY_ID']);
    }
}
