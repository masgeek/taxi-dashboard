<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/17/2017
 * Time: 12:33 PM
 */

namespace api\models;

/*
 * User_ID
Surname
Other_Names
Mobile
Email
Location_ID
User_Name
Password
User_Type

 */

use common\helper\APP_UTILS;

use common\models\Riders as RIDER_MODEL;
use common\models\Users;
use common\models\UserType;
use common\models\ApiToken;

/**
 * Class USER_MODEL
 * @package app\api\modules\v1\models
 * @property ApiToken $apiToken
 */
class USER_MODEL extends Users
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $CHANGE_PASSWORD;
    public $RETURN_MODEL;

    /**
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[APP_UTILS::SCENARIO_CREATE] = ['SURNAME', 'OTHER_NAMES', 'MOBILE', 'EMAIL', 'LOCATION_ID', 'USER_NAME', 'PASSWORD', 'USER_TYPE', 'RESET_TOKEN', 'USER_STATUS'];
        $scenarios[APP_UTILS::SCENARIO_UPDATE] = ['SURNAME', 'OTHER_NAMES', 'MOBILE', 'EMAIL', 'LOCATION_ID', 'USER_NAME', 'PASSWORD', 'USER_TYPE', 'RESET_TOKEN', 'USER_STATUS'];

        return $scenarios;
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['EMAIL', 'USER_NAME'], 'unique', 'on' => [APP_UTILS::SCENARIO_CREATE, APP_UTILS::SCENARIO_UPDATE]];
        $rules[] = [['PASSWORD'], 'string', 'min' => 6, 'on' => [APP_UTILS::SCENARIO_CREATE, APP_UTILS::SCENARIO_UPDATE]];
        return $rules;
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeSave($insert)
    {
        $date = APP_UTILS::GetCurrentDateTime();
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_REGISTERED = $date;
            }
            $this->LAST_UPDATED = $date;
            return true;
        }
        return false;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return $labels;
    }

    /**
     * @return array
     */
    public function fields()
    {
        $fields = parent::fields();

        $fields['USER_TYPE'] = function ($model) {
            /* @var $model Users */
            $user = UserType::findOne($model->USER_TYPE);
            if ($user != null) {
                return $user->USER_TYPE_NAME;
            }
            return 0;
        };

        $fields['RIDER_ID'] = function ($model) {
            /* @var $model Users */
            $rider = RIDER_MODEL::findOne(['USER_ID' => $model->USER_ID]);
            return $rider != null ? $rider->RIDER_ID : 0;
        };

        $fields['USER_STATUS'] = function ($model) {
            /* @var $model Users */
            return (boolean)$model->USER_STATUS;
        };

        $fields['API_TOKEN'] = function ($model) {
            /* @var $model Users */
            $token = $model->apiToken;
            return $token != null ? $token->API_TOKEN : 0;

        };

        $fields['HELPLINE'] = function ($model) {
            /* @var $model $this */
            return \Yii::$app->params['helpLine'];
        };

        $fields['MIN_PRICE'] = function ($model) {
            /* @var $model $this */
            $min_price = \Yii::$app->params['min_price'];
            return \Yii::$app->formatter->asDecimal($min_price, 2);
        };

        $fields['MOBILE'] = function ($model) {
            /* @var $model Users */
            $token = $model->apiToken;
            return $this->obfuscate_email($model->MOBILE);

        };

        $fields['EMAIL'] = function ($model) {
            /* @var $model Users */
            $token = $model->apiToken;
            return $this->obfuscate_email($model->EMAIL);

        };

        $fields['status'] = function ($model) {
            /* @var $model Users */
            return $model->status;

        };

        //unset($fields['MOBILE']);
        //unset($fields['EMAIL']);
        unset($fields['PASSWORD']); //remove the password field
        //unset($fields['RESET_TOKEN']); //remove the password field

        ksort($fields);
        return $fields;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApiToken()
    {
        return $this->hasOne(ApiToken::class, ['USER_ID' => 'USER_ID']);
    }

    private function obfuscate_email($email, $pos = "@", $minLength = 3, $maxLength = 10, $mask = "***")
    {
        $atPos = strrpos($email, $pos);
        $name = substr($email, 0, $atPos);
        $len = strlen($name);
        $domain = substr($email, $atPos);

        if (($len / 2) < $maxLength) $maxLength = ($len / 2);

        $shortenedEmail = (($len > $minLength) ? substr($name, 0, $maxLength) : "");
        return "{$shortenedEmail}{$mask}{$domain}";
    }
}