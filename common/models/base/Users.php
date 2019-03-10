<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $USER_ID
 * @property string $USER_NAME
 * @property int $USER_TYPE
 * @property string $SURNAME
 * @property string $OTHER_NAMES
 * @property string $MOBILE
 * @property string $EMAIL
 * @property int $LOCATION_ID
 * @property string $PASSWORD
 * @property string $DATE_REGISTERED
 * @property string $LAST_UPDATED
 * @property string $CLIENT_TOKEN
 * @property string $RESET_TOKEN
 * @property bool $USER_STATUS Indicate if user is active or not
 * @property string $TOKEN_EXPPIRY
 *
 * @property ApiToken[] $apiTokens
 * @property CustomerOrder[] $customerOrders
 * @property Riders[] $riders
 * @property AccessTokens[] $accessTokens
 * @property AuthorizationCodes[] $authorizationCodes
 * @property Cart[] $carts
 * @property Favs[] $favs
 * @property UserType $uSERTYPE
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER_NAME', 'USER_TYPE', 'SURNAME', 'OTHER_NAMES', 'MOBILE', 'EMAIL', 'PASSWORD', 'RESET_TOKEN'], 'required'],
            [['USER_TYPE', 'LOCATION_ID'], 'integer'],
            [['DATE_REGISTERED', 'LAST_UPDATED', 'TOKEN_EXPPIRY'], 'safe'],
            [['USER_STATUS'], 'boolean'],
            [['USER_NAME', 'SURNAME', 'OTHER_NAMES', 'EMAIL', 'PASSWORD', 'RESET_TOKEN'], 'string', 'max' => 100],
            [['MOBILE'], 'string', 'max' => 25],
            [['CLIENT_TOKEN'], 'string', 'max' => 255],
            [['USER_NAME'], 'unique'],
            [['EMAIL'], 'unique'],
            [['USER_TYPE'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['USER_TYPE' => 'USER_TYPE_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'USER_ID' => 'U S E R I D',
            'USER_NAME' => 'U S E R N A M E',
            'USER_TYPE' => 'U S E R T Y P E',
            'SURNAME' => 'S U R N A M E',
            'OTHER_NAMES' => 'O T H E R N A M E S',
            'MOBILE' => 'M O B I L E',
            'EMAIL' => 'E M A I L',
            'LOCATION_ID' => 'L O C A T I O N I D',
            'PASSWORD' => 'P A S S W O R D',
            'DATE_REGISTERED' => 'D A T E R E G I S T E R E D',
            'LAST_UPDATED' => 'L A S T U P D A T E D',
            'CLIENT_TOKEN' => 'C L I E N T T O K E N',
            'RESET_TOKEN' => 'R E S E T T O K E N',
            'USER_STATUS' => 'Indicate if user is active or not',
            'TOKEN_EXPPIRY' => 'T O K E N E X P P I R Y',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApiTokens()
    {
        return $this->hasMany(ApiToken::className(), ['USER_ID' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOrders()
    {
        return $this->hasMany(CustomerOrder::className(), ['USER_ID' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiders()
    {
        return $this->hasMany(Riders::className(), ['USER_ID' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessTokens()
    {
        return $this->hasMany(AccessTokens::className(), ['user_id' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorizationCodes()
    {
        return $this->hasMany(AuthorizationCodes::className(), ['user_id' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['USER_ID' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavs()
    {
        return $this->hasMany(Favs::className(), ['USER_ID' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSERTYPE()
    {
        return $this->hasOne(UserType::className(), ['USER_TYPE_ID' => 'USER_TYPE']);
    }
}
