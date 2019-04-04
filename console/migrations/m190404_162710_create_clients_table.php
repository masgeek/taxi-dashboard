<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clients}}`.
 */
class m190404_162710_create_clients_table extends \console\models\BaseMigration
{
    public $tableName = '{{%clients}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'name' => $this->string(255)->unique()->notNull()->comment('Client name'),
            'client_type' => $this->string(15)->notNull()->comment('Client type'),
            'email' => $this->string(150)->unique()->notNull(),
            'mobile' => $this->string(20)->unique()->notNull()->comment('Mobile number'),
            'tel' => $this->string(50)->unique()->comment('Landline'),
            'base_charge' => $this->double(2)->notNull()->comment('Charge per KM'),
            'min_charge' => $this->double(2)->notNull()->defaultValue(0)->comment('Minimum charge'),
            'waiting_charge' => $this->double(2)->notNull()->defaultValue(0),
            'currency' => $this->string(3)->notNull()->defaultValue('KES')
        ], $this->tableOptions);

        $this->addForeignKey('client_user_fk', $this->tableName, 'user_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('client_type_fk', $this->tableName, 'client_type', '{{%client_types}}', 'client_type', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('client_user_fk', $this->tableName);
        $this->dropForeignKey('client_type_fk', $this->tableName);
        $this->dropTable($this->tableName);
    }
}