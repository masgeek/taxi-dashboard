<?php

/**
 * Handles adding email to table `{{%users}}`.
 */
class m190406_225350_add_email_column_to_users_table extends \console\models\BaseMigration
{
    public $tableName = '{{%users}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'email', $this->string(100)->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
