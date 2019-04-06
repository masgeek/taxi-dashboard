<?php

/**
 * Handles the creation of table `{{%trip_invoices}}`.
 */
class m190404_182455_create_trip_invoice_items_table extends \console\models\BaseMigration
{
    public $tableName = '{{%trip_invoice_items}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'invoice_id' => $this->integer(11)->notNull(),
            'trip_id' => $this->integer(11)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ], $this->tableOptions);

        $this->addForeignKey('invoices_id_fk', $this->tableName, 'invoice_id', '{{%invoices}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('trip_id_fk', $this->tableName, 'trip_id', '{{%trips}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('invoices_id_fk', $this->tableName);
        $this->dropForeignKey('trip_id_fk', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
