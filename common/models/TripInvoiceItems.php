<?php

namespace common\models;

use \common\models\base\TripInvoiceItems as BaseTripInvoiceItems;

/**
 * This is the model class for table "tb_trip_invoice_items".
 */
class TripInvoiceItems extends BaseTripInvoiceItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['invoice_id', 'trip_id'], 'required'],
            [['invoice_id', 'trip_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['updated_by', 'created_by'], 'string', 'max' => 255]
        ]);
    }
	
}
