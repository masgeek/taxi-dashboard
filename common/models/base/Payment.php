<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $PAYMENT_ID
 * @property int $ORDER_ID
 * @property string $PAYMENT_CHANNEL
 * @property string $PAYMENT_AMOUNT
 * @property string $PAYMENT_REF
 * @property string $PAYMENT_STATUS
 * @property string $PAYMENT_DATE
 * @property string $PAYMENT_NOTES
 * @property string $PAYMENT_NUMBER
 *
 * @property Status $pAYMENTSTATUS
 * @property CustomerOrder $oRDER
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ORDER_ID'], 'integer'],
            [['PAYMENT_CHANNEL', 'PAYMENT_AMOUNT', 'PAYMENT_REF', 'PAYMENT_DATE'], 'required'],
            [['PAYMENT_AMOUNT'], 'number'],
            [['PAYMENT_DATE'], 'safe'],
            [['PAYMENT_CHANNEL', 'PAYMENT_REF', 'PAYMENT_NOTES'], 'string', 'max' => 255],
            [['PAYMENT_STATUS', 'PAYMENT_NUMBER'], 'string', 'max' => 30],
            [['PAYMENT_STATUS'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['PAYMENT_STATUS' => 'STATUS_NAME']],
            [['ORDER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerOrder::className(), 'targetAttribute' => ['ORDER_ID' => 'ORDER_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PAYMENT_ID' => 'P A Y M E N T I D',
            'ORDER_ID' => 'O R D E R I D',
            'PAYMENT_CHANNEL' => 'P A Y M E N T C H A N N E L',
            'PAYMENT_AMOUNT' => 'P A Y M E N T A M O U N T',
            'PAYMENT_REF' => 'P A Y M E N T R E F',
            'PAYMENT_STATUS' => 'P A Y M E N T S T A T U S',
            'PAYMENT_DATE' => 'P A Y M E N T D A T E',
            'PAYMENT_NOTES' => 'P A Y M E N T N O T E S',
            'PAYMENT_NUMBER' => 'P A Y M E N T N U M B E R',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPAYMENTSTATUS()
    {
        return $this->hasOne(Status::className(), ['STATUS_NAME' => 'PAYMENT_STATUS']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getORDER()
    {
        return $this->hasOne(CustomerOrder::className(), ['ORDER_ID' => 'ORDER_ID']);
    }
}
