<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trips}}`.
 */
class m190404_172746_create_trips_table extends \console\models\BaseMigration
{
    public $tableName = '{{%trips}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer(11)->notNull(),
            'assigned_vehicle_id' => $this->integer(11)->notNull(),
            'origin' => $this->text()->notNull(),
            'destination' => $this->text()->notNull(),
            'start_date' => $this->dateTime()->notNull(),
            'end_date' => $this->dateTime()->notNull(),
            'status' => $this->string()->notNull(),
            'distance_covered' => $this->double(3)->notNull()->defaultValue(0),
            'total_cost' => $this->double(2)->notNull()->defaultValue(0),
            'invoice_generated' => $this->boolean()->defaultValue(false)->notNull(),
            'map_image' => 'LONGBLOB',
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ],$this->tableOptions);

        $this->addForeignKey('trip_client_fk', $this->tableName, 'assigned_vehicle_id', '{{%assigned_vehicles}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('trip_assigned_vehicle_fk', $this->tableName, 'client_id', '{{%clients}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
