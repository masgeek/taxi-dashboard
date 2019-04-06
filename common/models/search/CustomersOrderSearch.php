<?php

namespace common\models\search;

use common\models\CustomerOrder;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CustomersOrderSearch represents the model behind the search form about `common\models\CustomerOrder`.
 */
class CustomersOrderSearch extends CustomerOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ORDER_ID', 'USER_ID', 'LOCATION_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID'], 'integer'],
            [['ORDER_DATE', 'PAYMENT_METHOD', 'ORDER_STATUS', 'ORDER_TIME', 'NOTES', 'CREATED_AT', 'UPDATED_AT'], 'safe'],
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
        $query = CustomerOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ORDER_ID' => $this->ORDER_ID,
            'USER_ID' => $this->USER_ID,
            'LOCATION_ID' => $this->LOCATION_ID,
            'KITCHEN_ID' => $this->KITCHEN_ID,
            'CHEF_ID' => $this->CHEF_ID,
            'RIDER_ID' => $this->RIDER_ID,
            'ORDER_DATE' => $this->ORDER_DATE,
            'CREATED_AT' => $this->CREATED_AT,
            'UPDATED_AT' => $this->UPDATED_AT,
        ]);

        $query->andFilterWhere(['like', 'PAYMENT_METHOD', $this->PAYMENT_METHOD])
            ->andFilterWhere(['like', 'ORDER_STATUS', $this->ORDER_STATUS])
            ->andFilterWhere(['like', 'ORDER_TIME', $this->ORDER_TIME])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES]);

        return $dataProvider;
    }
}
