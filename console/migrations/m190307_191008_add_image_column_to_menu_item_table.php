<?php

use yii\db\Migration;

/**
 * Handles adding image to table `{{%menutype}}`.
 */
class m190307_191008_add_image_column_to_menu_item_table extends \console\models\BaseMigration
{
    public $tableName = '{{menu_item}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'IMAGE', "LONGBLOB");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'IMAGE');
    }


}
