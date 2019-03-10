<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $LOCATION_ID
 * @property int $CITY_ID
 * @property string $LOCATION_NAME
 * @property string $ADDRESS
 * @property bool $ACTIVE
 *
 * @property CustomerOrder[] $customerOrders
 * @property City $cITY
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CITY_ID'], 'integer'],
            [['LOCATION_NAME'], 'required'],
            [['ADDRESS'], 'string'],
            [['ACTIVE'], 'boolean'],
            [['LOCATION_NAME'], 'string', 'max' => 255],
            [['CITY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['CITY_ID' => 'CITY_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LOCATION_ID' => 'L O C A T I O N I D',
            'CITY_ID' => 'C I T Y I D',
            'LOCATION_NAME' => 'L O C A T I O N N A M E',
            'ADDRESS' => 'A D D R E S S',
            'ACTIVE' => 'A C T I V E',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOrders()
    {
        return $this->hasMany(CustomerOrder::className(), ['LOCATION_ID' => 'LOCATION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCITY()
    {
        return $this->hasOne(City::className(), ['CITY_ID' => 'CITY_ID']);
    }
}
