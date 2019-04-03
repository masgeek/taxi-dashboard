<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth}}`.
 */
class m190307_190929_create_auth_table extends \console\models\BaseMigration
{
    public $tableName = '{{%authorization_codes}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'code' => $this->string(150)->notNull(),
            'user_id' => $this->integer(20),
            'app_id' => $this->string(200)->notNull(),
            'expires_at' => $this->integer(11)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ], $this->tableOptions);

        $this->addForeignKey('fk-auth-code', $this->tableName, 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-auth-code', $this->tableName);

        $this->dropTable($this->tableName);
    }
}
