<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth}}`.
 */
class m190307_190929_create_auth_table extends \console\models\BaseMigration
{
    public $tableName = '{{%authorization_codes}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * CREATE TABLE `authorization_codes` (
         * `id` int(11) NOT NULL,
         * `code` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
         * `expires_at` int(11) NOT NULL,
         * `user_id` int(11) NOT NULL,
         * `app_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
         * `created_at` int(11) NOT NULL,
         * `updated_at` int(11) NOT NULL
         * ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
         */
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'code' => $this->string(150)->notNull(),
            'user_id' => $this->bigInteger(20),
            'app_id' => $this->string(200)->notNull(),
            'expires_at' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $this->tableOptions);

        $this->addForeignKey('fk-auth-code', $this->tableName, 'user_id', '{{%users}}', 'user_id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-auth-code', $this->tableName);

        $this->dropTable($this->tableName);
    }
}
