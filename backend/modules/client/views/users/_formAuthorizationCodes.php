<div class="form-group" id="add-authorization-codes">
    <?php

    use kartik\builder\TabularForm;
    use kartik\grid\GridView;
    use yii\data\ArrayDataProvider;
    use yii\helpers\Html;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $row,
        'pagination' => [
            'pageSize' => -1
        ]
    ]);
    echo TabularForm::widget([
        'dataProvider' => $dataProvider,
        'formName' => 'AuthorizationCodes',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'code' => ['type' => TabularForm::INPUT_TEXT],
            'app_id' => ['type' => TabularForm::INPUT_TEXT],
            'expires_at' => ['type' => TabularForm::INPUT_TEXT],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => 'Delete', 'onClick' => 'delRowAuthorizationCodes(' . $key . '); return false;', 'id' => 'authorization-codes-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Tb Authorization Codes', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowAuthorizationCodes()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

