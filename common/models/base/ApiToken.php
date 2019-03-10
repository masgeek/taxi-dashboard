<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "api_token".
 *
 * @property int $TOKEN_ID
 * @property int $USER_ID
 * @property string $API_TOKEN
 * @property string $DATE_CREATED
 * @property string $EXPIRY_DATE
 *
 * @property Users $uSER
 */
class ApiToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER_ID'], 'integer'],
            [['DATE_CREATED', 'EXPIRY_DATE'], 'safe'],
            [['API_TOKEN'], 'string', 'max' => 255],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['USER_ID' => 'USER_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TOKEN_ID' => 'T O K E N I D',
            'USER_ID' => 'U S E R I D',
            'API_TOKEN' => 'A P I T O K E N',
            'DATE_CREATED' => 'D A T E C R E A T E D',
            'EXPIRY_DATE' => 'E X P I R Y D A T E',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(Users::className(), ['USER_ID' => 'USER_ID']);
    }
}
