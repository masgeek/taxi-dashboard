<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_type}}`.
 */
class m190330_164759_create_user_type_table extends \console\models\BaseMigration
{
    public $tableName = '{{%user_type}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'user_type' => $this->string(20)->comment('User Type')->unique(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ], $this->tableOptions);

        $this->addPrimaryKey('user_type_pk', $this->tableName, 'user_type');
        $this->addForeignKey('user_type_fk', '{{%users}}', 'user_type', $this->tableName, 'user_type', 'restrict', 'cascade');

        $this->insert($this->tableName, ['user_type' => 'DRIVER']);
        $this->insert($this->tableName, ['user_type' => 'CLIENT']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_type_fk', '{{%users}}');
        $this->dropTable($this->tableName);
    }
}
