<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tokens}}`.
 */
class m190300_190936_create_tokens_table extends \console\models\BaseMigration
{
    public $tableName = '{{%access_tokens}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'token' => $this->string(300)->notNull(),
            'auth_code' => $this->string(200)->notNull(),
            'user_id' => $this->bigInteger(20),
            'app_id' => $this->string(200)->notNull(),
            'expires_at' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $this->tableOptions);

        $this->addForeignKey('fk-access-tokens', $this->tableName, 'user_id', '{{%users}}', 'user_id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-access-tokens', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
