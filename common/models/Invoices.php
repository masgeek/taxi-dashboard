<?php

namespace common\models;

use common\models\base\Invoices as BaseInvoices;

/**
 * This is the model class for table "tb_invoices".
 */
class Invoices extends BaseInvoices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['invoice_id', 'invoice_sub_total', 'invoice_total'], 'required'],
            [['vat_percentage', 'invoice_sub_total', 'invoice_total'], 'number'],
            [['invoice_due_date', 'created_at', 'updated_at'], 'safe'],
            [['invoice_id', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['invoice_status'], 'string', 'max' => 15],
            [['invoice_id'], 'unique']
        ]);
    }
	
}
