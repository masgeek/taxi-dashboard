<?php

namespace common\models;

use \common\models\base\Clients as BaseClients;

/**
 * This is the model class for table "tb_clients".
 */
class Clients extends BaseClients
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'client_type', 'email', 'mobile', 'base_charge'], 'required'],
            [['base_charge', 'min_charge', 'waiting_charge'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'updated_by', 'created_by'], 'string', 'max' => 255],
            [['client_type'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 20],
            [['landline'], 'string', 'max' => 50],
            [['currency'], 'string', 'max' => 3],
            [['name'], 'unique'],
            [['email'], 'unique'],
            [['mobile'], 'unique'],
            [['landline'], 'unique']
        ]);
    }
	
}
