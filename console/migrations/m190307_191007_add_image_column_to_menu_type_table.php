<?php

use yii\db\Migration;

/**
 * Handles adding image to table `{{%menutype}}`.
 */
class m190307_191007_add_image_column_to_menu_type_table extends \console\models\BaseMigration
{
    public $tableName = '{{menu_category}}';

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
