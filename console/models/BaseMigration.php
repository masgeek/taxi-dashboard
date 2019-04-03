<?php
/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 3/7/2019
 * Time: 10:03 PM
 */

namespace console\models;

class BaseMigration extends \yii\db\Migration
{
    public $tableOptions;

    public $tableName;

    public $filePath;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->filePath = \Yii::getAlias('@console') . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }

    public function safeUp()
    {
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}