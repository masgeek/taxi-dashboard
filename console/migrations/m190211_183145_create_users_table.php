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
            'id' => $this->primaryKey(11),
            'username' => $this->string(20)->unique()->notNull()->comment('Username'),
            'password' => $this->string(300)->unique()->notNull(),
            'user_type' => $this->string(20)->notNull()->comment('User Type'),
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
