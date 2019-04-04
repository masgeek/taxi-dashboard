<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoices}}`.
 */
class m190404_182446_create_invoices_table extends \console\models\BaseMigration
{
    public $tableName = '{{%invoices}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'invoice_id' => $this->string(255)->unique()->notNull(),
            'vat_percentage' => $this->double(2)->notNull()->defaultValue(0),
            'invoice_sub_total' => $this->double(2)->notNull(),
            'invoice_total' => $this->double(2)->notNull(),
            'invoice_status' => $this->string(15)->notNull()->defaultValue('UNPAID'),
            'invoice_due_date' => $this->timestamp(null),
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
