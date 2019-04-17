<div class="form-group" id="add-user-client">
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
        'formName' => 'UserClient',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'client_id' => [
                'label' => 'Tb clients',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Clients::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                    'options' => ['placeholder' => 'Choose Tb clients'],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => 'Delete', 'onClick' => 'delRowUserClient(' . $key . '); return false;', 'id' => 'user-client-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Tb User Client', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowUserClient()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

