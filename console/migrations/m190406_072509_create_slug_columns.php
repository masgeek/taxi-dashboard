<?php

use console\models\BaseMigration;
use yii\db\Schema;

/**
 * Class m190406_072509_create_slug_columns
 */
class m190406_072509_create_slug_columns extends BaseMigration
{
    public $excludedTables = ['migration', 'users', 'authorization_codes', 'access_tokens'];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->getTables() as $tableName) {
            $this->addColumn($tableName, 'slug', Schema::TYPE_STRING);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->getTables() as $tableName) {
            $this->dropColumn($tableName, 'slug');
        }
    }
}
