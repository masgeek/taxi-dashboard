<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190211_183145_create_users_table extends \console\models\BaseMigration
{
    public $tableName = '{{%users}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'user_id' => $this->primaryKey(20),
            'username' => $this->string(20)->unique()->notNull()->comment('Username'),
            'password' => $this->string(300)->unique()->notNull(),
            'user_type' => $this->string(50)->notNull()->comment('User Tpe'),
            'account_active' => $this->boolean()->defaultValue(true)->comment('Account Active'),
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
