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
            'driver_id' => $this->integer(11)->notNull(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ], $this->tableOptions);

        $this->addForeignKey('driver_user_fk', $this->tableName, 'driver_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('driver_user_fk', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
