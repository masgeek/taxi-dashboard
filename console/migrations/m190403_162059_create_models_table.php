<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%models}}`.
 */
class m190403_162059_create_models_table extends \console\models\BaseMigration
{
    public $tableName = '{{%models}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment("Vehicle name"),
            'make_year_id' => $this->integer(11)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);

        //CONSTRAINT `models_ibfk_1` FOREIGN KEY (`makeyear_id`) REFERENCES `make_years` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
        $this->addForeignKey('models_fk', $this->tableName, 'make_year_id', '{{%make_years}}', 'id', 'RESTRICT', 'CASCADE');

        // UNIQUE KEY `compositeIndex` (`name`,`makeyear_id`),
        $this->createIndex('makename_unique', $this->tableName, ['name', 'make_year_id'], true);
        //create a composite index
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('models_fk', $this->tableName);
        $this->dropIndex('makename_unique', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
