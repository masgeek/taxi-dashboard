<?php

/**
 * Class m190403_172141_insert_vehicle_makes
 */
class m190403_172141_insert_vehicle_makes extends \console\models\BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $importer = new \ruskid\csvimporter\CSVImporter();
        $importer->setData(new \ruskid\csvimporter\CSVReader([
            'filename' => "{$this->filePath}make.csv",
            'fgetcsvOptions' => [
                'delimiter' => ','
            ]
        ]));

        $numberRowsAffected = $importer->import(new \ruskid\csvimporter\MultipleImportStrategy([
            'tableName' => \common\models\Makes::tableName(),
            'configs' => [
                [
                    'attribute' => 'id',
                    'value' => function ($line) {
                        return $line[0];
                    },
                    'unique' => true, //Will filter and import unique values only. can by applied for 1+ attributes
                ],
                [
                    'attribute' => 'name',
                    'value' => function ($line) {
                        return $line[1];
                    },
                ]
            ],
        ]));
        echo "Inserted {$numberRowsAffected} makes \n";

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        \common\models\Makes::deleteAll();
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190403_172141_insert_vehicle_makes cannot be reverted.\n";

        return false;
    }
    */
}
