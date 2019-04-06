<?php

use console\models\BaseMigration;

/**
 * Class m190406_220850_change_time_column_to_integer
 */
class m190406_220850_change_time_column_to_integer extends BaseMigration
{
    public $excludedTables = ['migration'];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->getTables() as $tableName) {
            $this->dropColumn($tableName, 'created_at');
            $this->dropColumn($tableName, 'updated_at');

            $this->addColumn($tableName, 'created_at', $this->integer(11)->defaultValue(time()));
            $this->addColumn($tableName, 'updated_at', $this->integer(11)->defaultValue(time()));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
