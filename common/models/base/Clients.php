<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%clients}}".
 *
 * @property int $id
 * @property string $name Client name
 * @property string $client_type Client type
 * @property string $email
 * @property string $mobile Mobile number
 * @property string $landline Landline
 * @property double $base_charge Charge per KM
 * @property double $min_charge Minimum charge
 * @property double $waiting_charge
 * @property string $currency
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property ClientTypes $clientType
 * @property Trips[] $trips
 * @property UserClient[] $userClients
 */
class Clients extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%clients}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'client_type', 'email', 'mobile', 'base_charge'], 'required'],
            [['base_charge', 'min_charge', 'waiting_charge'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['client_type'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 20],
            [['landline'], 'string', 'max' => 50],
            [['currency'], 'string', 'max' => 3],
            [['name'], 'unique'],
            [['email'], 'unique'],
            [['mobile'], 'unique'],
            [['landline'], 'unique'],
            [['client_type'], 'exist', 'skipOnError' => true, 'targetClass' => ClientTypes::className(), 'targetAttribute' => ['client_type' => 'client_type']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Client name',
            'client_type' => 'Client type',
            'email' => 'Email',
            'mobile' => 'Mobile number',
            'landline' => 'Landline',
            'base_charge' => 'Charge per KM',
            'min_charge' => 'Minimum charge',
            'waiting_charge' => 'Waiting Charge',
            'currency' => 'Currency',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientType()
    {
        return $this->hasOne(ClientTypes::className(), ['client_type' => 'client_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trips::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClients()
    {
        return $this->hasMany(UserClient::className(), ['client_id' => 'id']);
    }
}
