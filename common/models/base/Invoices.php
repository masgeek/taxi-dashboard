<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%invoices}}".
 *
 * @property int $id
 * @property string $invoice_id
 * @property double $vat_percentage
 * @property double $invoice_sub_total
 * @property double $invoice_total
 * @property string $invoice_status
 * @property string $invoice_due_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property TripInvoiceItems[] $tripInvoiceItems
 */
class Invoices extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%invoices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice_id', 'invoice_sub_total', 'invoice_total'], 'required'],
            [['vat_percentage', 'invoice_sub_total', 'invoice_total'], 'number'],
            [['invoice_due_date', 'created_at', 'updated_at'], 'safe'],
            [['invoice_id', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['invoice_status'], 'string', 'max' => 15],
            [['invoice_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'vat_percentage' => 'Vat Percentage',
            'invoice_sub_total' => 'Invoice Sub Total',
            'invoice_total' => 'Invoice Total',
            'invoice_status' => 'Invoice Status',
            'invoice_due_date' => 'Invoice Due Date',
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
    public function getTripInvoiceItems()
    {
        return $this->hasMany(TripInvoiceItems::className(), ['invoice_id' => 'id']);
    }
}
