<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%drivers}}`.
 */
class m190403_181226_create_drivers_table extends \console\models\BaseMigration
{
    public $tableName = '{{%drivers}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string(11)->unique()->notNull(),
            'email' => $this->string(150)->unique()->notNull(),
            'mobile' => $this->string(20)->unique()->notNull(),
            'active' => $this->boolean()->defaultValue(true),
            'password' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ], $this->tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
