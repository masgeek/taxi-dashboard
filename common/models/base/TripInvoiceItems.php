<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%trip_invoice_items}}".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $trip_id
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Invoices $invoice
 * @property \common\models\Trips $trip
 */
class TripInvoiceItems extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'trip_id'], 'required'],
            [['invoice_id', 'trip_id', 'created_at', 'updated_at'], 'integer'],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 30],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%trip_invoice_items}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'trip_id' => 'Trip ID',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(\common\models\Invoices::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(\common\models\Trips::className(), ['id' => 'trip_id']);
    }
}
