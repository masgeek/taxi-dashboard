<?php

namespace common\models;

use common\models\base\CustomerOrderItem as BaseCustomerOrderItem;

/**
 * This is the model class for table "customer_order_item".
 */
class CustomerOrderItem extends BaseCustomerOrderItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['ORDER_ID', 'ITEM_TYPE_ID', 'QUANTITY', 'PRICE', 'SUBTOTAL', 'CREATED_AT'], 'required'],
                [['ORDER_ID', 'ITEM_TYPE_ID', 'QUANTITY'], 'integer'],
                [['PRICE', 'SUBTOTAL'], 'number'],
                [['CREATED_AT', 'UPDATED_AT'], 'safe'],
                [['OPTIONS'], 'string', 'max' => 100],
                [['NOTES'], 'string', 'max' => 200]
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return $this->attributeLabels();
    }

    /** custom functions **/
    public static function GetOrderTotal($order_id)
    {
        return self::find()->where(['ORDER_ID' => $order_id])->sum('SUBTOTAL');

    }

    public static function GetOrderQuantity($order_id)
    {
        return self::find()->where(['ORDER_ID' => $order_id])->sum('QUANTITY');
    }

    public static function BuildItemsTable($model)
    {
        $formatter = \Yii::$app->formatter;
        $orderTotal = 0.0;
        $table = <<<TABLE

<table data-height="auto" class="table table-condensed">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>Items</th>
    </tr>
    </thead>
    <tbody>
TABLE;


        foreach ($model as $orderItems):
            $table .= '<tr>';
//lets do the order total here
            $orderTotal = $orderTotal + (float)$orderItems->SUBTOTAL;
            $table .= "<td>{$orderItems->QUANTITY}x</td>";
            $table .= "<td>{$orderItems->iTEMTYPE->mENUITEM->MENU_ITEM_NAME} ({$orderItems->iTEMTYPE->ITEM_TYPE_SIZE})</td>";
            $table .= '</tr>';
        endforeach;

        $table .= <<<TABLE
    <tr>
        <td class="thick-line"></td>
        <td class="thick-line"></td>
    </tr>
    </tbody>
</table>
TABLE;

        return $table;
    }

    public static function GetItemTypes($order_id)
    {
        /* @var $model $this */
        $data = self::find()
            ->where(['ORDER_ID' => $order_id])
            ->all();

        //let us rebuild the array
        $itemDetails = [];
        foreach ($data as $model) {
            $itemDetails[] = [
                'ORDER_ITEMS' => $model,
                'ITEM_TYPE' => $model->iTEMTYPE,
                'MENU_ITEM' => $model->iTEMTYPE->mENUITEM
            ];
        }
        return $itemDetails;
    }
}
