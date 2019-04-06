<?php

namespace common\models\base;

/**
 * This is the model class for table "riders".
 *
 * @property int $RIDER_ID
 * @property int $USER_ID
 * @property int $KITCHEN_ID
 * @property bool $RIDER_STATUS
 *
 * @property CustomerOrder[] $customerOrders
 * @property Kitchen $kITCHEN
 * @property Users $uSER
 */
class Riders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER_ID', 'KITCHEN_ID'], 'integer'],
            [['RIDER_STATUS'], 'boolean'],
            [['KITCHEN_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Kitchen::className(), 'targetAttribute' => ['KITCHEN_ID' => 'KITCHEN_ID']],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['USER_ID' => 'USER_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RIDER_ID' => 'R I D E R I D',
            'USER_ID' => 'U S E R I D',
            'KITCHEN_ID' => 'K I T C H E N I D',
            'RIDER_STATUS' => 'R I D E R S T A T U S',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOrders()
    {
        return $this->hasMany(CustomerOrder::className(), ['RIDER_ID' => 'RIDER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKITCHEN()
    {
        return $this->hasOne(Kitchen::className(), ['KITCHEN_ID' => 'KITCHEN_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(Users::className(), ['USER_ID' => 'USER_ID']);
    }
}
