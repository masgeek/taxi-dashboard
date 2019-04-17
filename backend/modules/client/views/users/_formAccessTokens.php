<div class="form-group" id="add-access-tokens">
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
        'formName' => 'AccessTokens',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'token' => ['type' => TabularForm::INPUT_TEXT],
            'auth_code' => ['type' => TabularForm::INPUT_TEXT],
            'app_id' => ['type' => TabularForm::INPUT_TEXT],
            'expires_at' => ['type' => TabularForm::INPUT_TEXT],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => 'Delete', 'onClick' => 'delRowAccessTokens(' . $key . '); return false;', 'id' => 'access-tokens-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Tb Access Tokens', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowAccessTokens()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

