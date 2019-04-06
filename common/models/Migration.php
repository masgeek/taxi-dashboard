<?php

namespace common\models;

use common\models\base\Migration as BaseMigration;

/**
 * This is the model class for table "tb_migration".
 */
class Migration extends BaseMigration
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['version'], 'required'],
            [['apply_time'], 'integer'],
            [['version'], 'string', 'max' => 180]
        ]);
    }
	
}
