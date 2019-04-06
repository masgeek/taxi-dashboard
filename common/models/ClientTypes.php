<?php

namespace common\models;

use common\models\base\ClientTypes as BaseClientTypes;

/**
 * This is the model class for table "tb_client_types".
 */
class ClientTypes extends BaseClientTypes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['client_type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['client_type'], 'string', 'max' => 15],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['client_type'], 'unique']
        ]);
    }
	
}
