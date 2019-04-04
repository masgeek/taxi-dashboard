<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_client}}`.
 */
class m190404_181404_create_user_client_table extends \console\models\BaseMigration
{
    public $tableName = '{{%user_client}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'client_id' => $this->integer(11)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ], $this->tableOptions);

        $this->addForeignKey('client_user_fk', $this->tableName, 'user_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('user_client_fk', $this->tableName, 'client_id', '{{%clients}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('client_user_fk', $this->tableName);
        $this->dropForeignKey('user_client_fk', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
