<?php

/**
 * Handles the creation of table `{{%client_types}}`.
 */
class m190404_161154_create_client_types_table extends \console\models\BaseMigration
{
    public $tableName = '{{%client_types}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'client_type' => $this->string(15)->notNull()->unique(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ], $this->tableOptions);

        $this->addPrimaryKey('client_type_pk', $this->tableName, 'client_type');

        //add initial records
        $this->insert($this->tableName, ['client_type' => 'CORPORATE']);
        $this->insert($this->tableName, ['client_type' => 'NON-CORPORATE']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
