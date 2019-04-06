<?php

namespace common\models;

use common\models\base\Location as BaseLocation;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "location".
 */
class Location extends BaseLocation
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LOCATION_ID' => Yii::t('app', 'Location  ID'),
            'CITY_ID' => Yii::t('app', 'City  ID'),
            'LOCATION_NAME' => Yii::t('app', 'Location  Name'),
            'ADDRESS' => Yii::t('app', 'Address'),
            'ACTIVE' => Yii::t('app', 'Active'),
        ];
    }


    public static function GetActiveLocation()
    {
        $location = self::find()
            ->where(['ACTIVE' => true])
            ->all();

        $listData = ArrayHelper::map($location, 'LOCATION_ID', 'LOCATION_NAME');

        return $listData;
    }

    public static function GetAllLocations()
    {
        $location = self::find()
            ->all();

        $listData = ArrayHelper::map($location, 'LOCATION_ID', 'LOCATION_NAME');

        return $listData;
    }
}
