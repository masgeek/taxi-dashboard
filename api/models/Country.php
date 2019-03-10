<?php
/**
 * Created by PhpStorm.
 * User: MASGEEK
 * Date: 7/25/2018
 * Time: 11:51 AM
 */

namespace api\models;

use Yii;
use yii\helpers\ArrayHelper;

class Country extends \common\models\Country
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COUNRY_ID' => Yii::t('app', 'Counry  ID'),
            'COUNTRY_NAME' => Yii::t('app', 'Country  Name'),
        ];
    }

    public static function GetCountry()
    {
        $country = self::find()
            ->all();

        $listData = ArrayHelper::map($country, 'COUNRY_ID', 'COUNTRY_NAME');

        return $listData;
    }
}