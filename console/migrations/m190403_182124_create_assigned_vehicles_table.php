<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assigned_vehicles}}`.
 */
class m190403_182124_create_assigned_vehicles_table extends \console\models\BaseMigration
{
    public $tableName = '{{%assigned_vehicles}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'driver_id' => $this->integer(11)->notNull(),
            'vehicle_id' => $this->integer(11)->notNull(),
            'date_assigned' => $this->date()->notNull(),
            'date_unassigned' => $this->date(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ]);

        $this->addForeignKey('driver_assigned_fk', $this->tableName, 'driver_id', '{{%drivers}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('vehicle_assigned_fk', $this->tableName, 'vehicle_id', '{{%vehicles}}', 'id', 'RESTRICT', 'CASCADE');

        $this->createIndex('unique_assignment_idx', $this->tableName, ['driver_id', 'vehicle_id', 'date_assigned'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('driver_assigned_fk', $this->tableName);
        $this->dropForeignKey('vehicle_assigned_fk', $this->tableName);
        $this->dropIndex('unique_assignment_idx', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
