<?php

namespace common\models\search;

use common\models\VwOrders;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VwCustomerOrdersSearch represents the model behind the search form about `common\models\VwOrders`.
 */
class VwCustomerOrdersSearch extends VwOrders
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
     * @param array $order_status
     * @return ActiveDataProvider
     */
    public function search($params, array $order_status)
    {
        $query = VwOrders::find();

        // add conditions that should always apply here

        $query->andWhere(['ORDER_STATUS' => $order_status]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'CREATED_AT' => SORT_DESC,
                    // 'ORDER_DATE' => SORT_DESC,
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


    /**
     * @param $params
     * @param $rider_id
     * @param array $order_status
     * @return ActiveDataProvider
     */
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


    /**
     * @param       $params
     * @param array $order_status
     * @return ActiveDataProvider
     */
    public function searchKitchenQueue(array $params, array $order_status, $pagination = ['pageSize' => 20,])
    {
        $query = VwOrders::find();

        // add conditions that should always apply here
        $query->andWhere(['ORDER_STATUS' => $order_status]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
            'sort' => [
                'defaultOrder' => [
                    'ORDER_DATE' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ORDER_ID' => $this->ORDER_ID,
            'USER_ID' => $this->USER_ID,
            'LOCATION_ID' => $this->LOCATION_ID,
            'CHEF_ID' => $this->CHEF_ID,
            'RIDER_ID' => $this->RIDER_ID,
            'ORDER_STATUS' => $this->ORDER_STATUS,
        ]);

        $query->andFilterWhere(['like', 'PAYMENT_METHOD', $this->PAYMENT_METHOD])
            //->andFilterWhere(['like', 'ORDER_STATUS', $this->ORDER_STATUS])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @param array $order_status
     * @return ActiveDataProvider
     */
    public function searchCustomerOrders($params, array $order_status, $user_id)
    {
        $query = VwOrders::find();

        // add conditions that should always apply here

        $query->andWhere(['USER_ID' => $user_id]);
        $query->andWhere(['ORDER_STATUS' => $order_status]);

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
            // 'ORDER_DATE' => $this->ORDER_DATE,
            'CREATED_AT' => $this->CREATED_AT,
            'UPDATED_AT' => $this->UPDATED_AT,
            'SURNAME' => $this->SURNAME,
            'OTHER_NAMES' => $this->OTHER_NAMES,
            'MOBILE' => $this->MOBILE,
            'PAYMENT_NUMBER' => $this->PAYMENT_NUMBER,
        ]);

        if ($this->ORDER_DATE != null && strlen($this->ORDER_DATE) > 1) {
            $date = explode("TO", $this->ORDER_DATE);
            $this->START_DATE = trim($date[0]);
            $this->END_DATE = trim($date[1]);
        } else {
            $this->START_DATE = $this->FirstDayOfMonth();
            $this->END_DATE = $this->LastDayOfMonth();
        }


        $query->andFilterWhere(['like', 'PAYMENT_METHOD', $this->PAYMENT_METHOD])
            ->andFilterWhere(['like', 'ORDER_ID', $this->ORDER_ID])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES])
            ->andFilterWhere(['between', 'ORDER_DATE', $this->START_DATE, $this->END_DATE]);

        return $dataProvider;
    }

    private function FirstDayOfMonth($format = 'Y-m-d')
    {
        return date($format, strtotime('first day of this month'));
    }

    private function LastDayOfMonth($format = 'Y-m-d')
    {
        return date($format, strtotime('last day of this month'));
    }
}
