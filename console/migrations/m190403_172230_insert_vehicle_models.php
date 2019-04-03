<?php

use yii\db\Migration;

/**
 * Class m190403_172230_insert_vehicle_models
 */
class m190403_172230_insert_vehicle_models extends \console\models\BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $importer = new \ruskid\csvimporter\CSVImporter();
        $importer->setData(new \ruskid\csvimporter\CSVReader([
            'filename' => "{$this->filePath}models.csv",
            'fgetcsvOptions' => [
                'delimiter' => ','
            ]
        ]));

        $numberRowsAffected = $importer->import(new \ruskid\csvimporter\MultipleImportStrategy([
            'tableName' => \common\models\Models::tableName(),
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
                ],
                [
                    'attribute' => 'make_year_id',
                    'value' => function ($line) {
                        return $line[2];
                    },
                ]
            ],
        ]));
        echo "Inserted {$numberRowsAffected} models \n";

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        \common\models\Models::deleteAll();
        return true;
    }
}
