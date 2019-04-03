<?php

use yii\db\Migration;

/**
 * Class m190403_172221_insert_vehicle_makes_year
 */
class m190403_172221_insert_vehicle_makes_year extends \console\models\BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $importer = new \ruskid\csvimporter\CSVImporter();
        $importer->setData(new \ruskid\csvimporter\CSVReader([
            'filename' => "{$this->filePath}make_year.csv",
            'fgetcsvOptions' => [
                'delimiter' => ','
            ]
        ]));

        $numberRowsAffected = $importer->import(new \ruskid\csvimporter\MultipleImportStrategy([
            'tableName' => \common\models\MakeYears::tableName(),
            'configs' => [
                [
                    'attribute' => 'id',
                    'value' => function ($line) {
                        return $line[0];
                    },
                    'unique' => true, //Will filter and import unique values only. can by applied for 1+ attributes
                ],
                [
                    'attribute' => 'year',
                    'value' => function ($line) {
                        return $line[1];
                    },
                ],
                [
                    'attribute' => 'make_id',
                    'value' => function ($line) {
                        return $line[2];
                    },
                ]
            ],
        ]));
        echo "Inserted {$numberRowsAffected} make year \n";

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        \common\models\MakeYears::deleteAll();
        return true;
    }
}
