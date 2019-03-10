<?php

namespace common\models;

use Yii;
use \common\models\base\Riders as BaseRiders;

/**
 * This is the model class for table "riders".
 */
class Riders extends BaseRiders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['KITCHEN_ID'], 'required'];

        return $rules;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        $labels['KITCHEN_ID'] = Yii::t('app', 'Designated Kitchen');
        $labels['USER_ID'] = Yii::t('app', 'Rider Name');
        $labels['RIDER_STATUS'] = Yii::t('app', 'Rider Active');

        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return $this->attributeLabels();
    }


    public static function GetRiders($kitchen_id, $asModel = false)
    {
        $riders = self::find()
            ->with('uSER')
            ->where(['KITCHEN_ID' => $kitchen_id])
            ->andWhere(['RIDER_STATUS' => 1])
            ->all();

        $riders_arr = [];
        foreach ($riders as $key => $rider) {
            $riders_arr[$rider->RIDER_ID] = "{$rider->uSER->SURNAME}, {$rider->uSER->OTHER_NAMES}";
        }

        return $asModel ? $riders : $riders_arr;
    }

    public
    static function GetAllRiders()
    {
        $riders = self::find()
            ->with('uSER')
            ->all();

        $riders_arr = [];
        foreach ($riders as $key => $rider) {
            $riders_arr[$rider->RIDER_ID] = "{$rider->uSER->SURNAME}, {$rider->uSER->OTHER_NAMES}";
        }

        return $riders_arr;
    }
}
