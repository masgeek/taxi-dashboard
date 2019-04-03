<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%make}}`.
 */
class m190403_162025_create_makes_table extends \console\models\BaseMigration
{
    public $tableName = '{{%makes}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique()->comment("Vehicle Make")
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
