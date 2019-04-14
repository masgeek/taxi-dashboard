<?php

/**
 * Class m190414_175543_add_rate_limit_columns
 */
class m190414_175543_add_rate_limit_columns extends \console\models\BaseMigration
{
    public $tableName = '{{%users}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//$allowance
        //$allowance_updated_at
        $this->addColumn($this->tableName, 'allowance', $this->integer(15));
        $this->addColumn($this->tableName, 'allowance_updated_at', $this->integer(15));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

}
