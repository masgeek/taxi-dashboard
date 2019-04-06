<?php

/**
 * Handles the creation of table `{{%make_years}}`.
 */
class m190403_162035_create_make_years_table extends \console\models\BaseMigration
{
    public $tableName = '{{%make_years}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'year' => $this->integer(11)->notNull()->comment("Year of manufacture"),
            'make_id' => $this->integer(11)->comment("Vehicle make"),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
        ], $this->tableOptions);

        //  CONSTRAINT `make_years_ibfk_1` FOREIGN KEY (`make_id`) REFERENCES `makes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
        $this->addForeignKey('make_years_fk', $this->tableName, 'make_id', '{{%makes}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('make_years_fk', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
