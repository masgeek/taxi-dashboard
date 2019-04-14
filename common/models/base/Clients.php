<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%clients}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $client_type
 * @property string $email
 * @property string $mobile
 * @property string $landline
 * @property double $base_charge
 * @property double $min_charge
 * @property double $waiting_charge
 * @property string $currency
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\ClientTypes $clientType
 * @property \common\models\Trips[] $trips
 * @property \common\models\UserClient[] $userClients
 */
class Clients extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'client_type', 'email', 'mobile', 'base_charge'], 'required'],
            [['base_charge', 'min_charge', 'waiting_charge'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'updated_by', 'created_by'], 'string', 'max' => 255],
            [['client_type'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 20],
            [['landline'], 'string', 'max' => 50],
            [['currency'], 'string', 'max' => 3],
            [['slug'], 'string', 'max' => 30],
            [['name'], 'unique'],
            [['email'], 'unique'],
            [['mobile'], 'unique'],
            [['landline'], 'unique'],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%clients}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'client_type' => 'Client Type',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'landline' => 'Landline',
            'base_charge' => 'Base Charge',
            'min_charge' => 'Min Charge',
            'waiting_charge' => 'Waiting Charge',
            'currency' => 'Currency',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientType()
    {
        return $this->hasOne(\common\models\ClientTypes::className(), ['client_type' => 'client_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(\common\models\Trips::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClients()
    {
        return $this->hasMany(\common\models\UserClient::className(), ['client_id' => 'id']);
    }
}
