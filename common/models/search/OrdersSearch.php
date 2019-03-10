<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VwOrders;

/**
 * OrdersSearch represents the model behind the search form about `common\models\VwOrders`.
 */
class OrdersSearch extends VwOrders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ORDER_ID', 'USER_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID', 'LOCATION_ID', 'CITY_ID', 'COUNRY_ID'], 'integer'],
            [['MOBILE', 'SURNAME', 'OTHER_NAMES', 'ORDER_DATE', 'ORDER_STATUS', 'PAYMENT_NUMBER', 'NOTES', 'PAYMENT_METHOD', 'CREATED_AT', 'UPDATED_AT', 'PAYMENT_DATE', 'LOCATION_NAME', 'ADDRESS', 'CITY_NAME', 'COUNTRY_NAME', 'ORDER_TIME'], 'safe'],
            [['PAYMENT_AMOUNT'], 'number'],
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
        $query = VwOrders::find();

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
            'KITCHEN_ID' => $this->KITCHEN_ID,
            'CHEF_ID' => $this->CHEF_ID,
            'RIDER_ID' => $this->RIDER_ID,
            'ORDER_DATE' => $this->ORDER_DATE,
            'PAYMENT_AMOUNT' => $this->PAYMENT_AMOUNT,
            'CREATED_AT' => $this->CREATED_AT,
            'UPDATED_AT' => $this->UPDATED_AT,
            'PAYMENT_DATE' => $this->PAYMENT_DATE,
            'LOCATION_ID' => $this->LOCATION_ID,
            'CITY_ID' => $this->CITY_ID,
            'COUNRY_ID' => $this->COUNRY_ID,
        ]);

        $query->andFilterWhere(['like', 'MOBILE', $this->MOBILE])
            ->andFilterWhere(['like', 'SURNAME', $this->SURNAME])
            ->andFilterWhere(['like', 'OTHER_NAMES', $this->OTHER_NAMES])
            ->andFilterWhere(['like', 'ORDER_STATUS', $this->ORDER_STATUS])
            ->andFilterWhere(['like', 'PAYMENT_NUMBER', $this->PAYMENT_NUMBER])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES])
            ->andFilterWhere(['like', 'PAYMENT_METHOD', $this->PAYMENT_METHOD])
            ->andFilterWhere(['like', 'LOCATION_NAME', $this->LOCATION_NAME])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'CITY_NAME', $this->CITY_NAME])
            ->andFilterWhere(['like', 'COUNTRY_NAME', $this->COUNTRY_NAME])
            ->andFilterWhere(['like', 'ORDER_TIME', $this->ORDER_TIME]);

        return $dataProvider;
    }

    public function searchRiderOrders($params, $rider_id, array $order_status = [])
    {
        $query = VwOrders::find();

        // add conditions that should always apply here

        if (count($order_status) > 0) {
            $query->andWhere(['ORDER_STATUS' => $order_status]);
        }

        $query->andWhere(['RIDER_ID' => $rider_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'ORDER_DATE' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'USER_ID' => $this->USER_ID,
            'LOCATION_ID' => $this->LOCATION_ID,
            'CHEF_ID' => $this->CHEF_ID,
            'RIDER_ID' => $this->RIDER_ID,
            'ORDER_DATE' => $this->ORDER_DATE,
            'CREATED_AT' => $this->CREATED_AT,
            'UPDATED_AT' => $this->UPDATED_AT,
            'SURNAME' => $this->SURNAME,
            'OTHER_NAMES' => $this->OTHER_NAMES,
            'MOBILE' => $this->MOBILE,
            'PAYMENT_NUMBER' => $this->PAYMENT_NUMBER,
        ]);

        $query->andFilterWhere(['like', 'PAYMENT_METHOD', $this->PAYMENT_METHOD])
            ->andFilterWhere(['like', 'ORDER_ID', $this->ORDER_ID])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES]);

        return $dataProvider;
    }

}
