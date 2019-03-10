<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cart;

/**
 * CartSearch represents the model behind the search form about `common\models\Cart`.
 */
class CartSearch extends Cart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CART_ITEM_ID', 'USER_ID', 'ITEM_TYPE_ID', 'QUANTITY', 'CART_TIMESTAMP'], 'integer'],
            [['ITEM_PRICE'], 'number'],
            [['ITEM_TYPE_SIZE', 'NOTES', 'CREATED_AT', 'UPDATED_AT'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Cart::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'CART_ITEM_ID' => $this->CART_ITEM_ID,
            'USER_ID' => $this->USER_ID,
            'ITEM_TYPE_ID' => $this->ITEM_TYPE_ID,
            'QUANTITY' => $this->QUANTITY,
            'ITEM_PRICE' => $this->ITEM_PRICE,
            'CART_TIMESTAMP' => $this->CART_TIMESTAMP,
            'CREATED_AT' => $this->CREATED_AT,
            'UPDATED_AT' => $this->UPDATED_AT,
        ]);

        $query->andFilterWhere(['like', 'ITEM_TYPE_SIZE', $this->ITEM_TYPE_SIZE])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES]);

        return $dataProvider;
    }
}
