<?php

/**
 * Handles the creation of table `{{%vehicles}}`.
 */
class m190403_175723_create_vehicles_table extends \console\models\BaseMigration
{
    public $tableName = '{{%vehicles}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer(11),
            'capacity' => $this->integer(3)->defaultValue(5)->comment('Sitting capacity')->notNull(),
            'color' => $this->integer(3)->defaultValue(5)->comment('Vehicle color'),
            'mileage' => $this->float(3)->comment('Mileage'),
            'total_distance' => $this->float(2)->comment('Total distance covered'),
            'reg_no' => $this->string(10)->notNull()->unique()->comment('Registration'),
            'reg_year' => $this->date()->notNull()->comment('Registration year'),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ], $this->tableOptions);

        $this->addForeignKey('vehicle_models_fk', $this->tableName, 'model_id', '{{%models}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('vehicle_models_fk', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
