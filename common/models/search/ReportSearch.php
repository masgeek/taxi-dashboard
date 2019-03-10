<?php

namespace common\models\search;

use common\helper\APP_UTILS;
use common\helper\OrderHelper as ORDER_HELPER;
use common\models\VwSalesReports;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReportSearch represents the model behind the search form of `app\model_extended\ReportModel`.
 */
class ReportSearch extends VwSalesReports
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ORDER_ID', 'LOCATION_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID', 'USER_ID', 'USER_TYPE', 'COUNTRY_ID'], 'integer'],
            [['ORDER_DATE', 'PAYMENT_METHOD', 'ORDER_STATUS', 'ORDER_TIME', 'NOTES', 'CREATED_AT', 'UPDATED_AT', 'USER_NAME', 'SURNAME', 'OTHER_NAMES', 'LOCATION_NAME', 'CHEF_NAME'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param bool $allOrders
     * @return ActiveDataProvider
     */
    public function GeneralSearch($params, $order_status = [], $allOrders = false)
    {
        $query = self::find();

        $this->START_DATE = APP_UTILS::FirstDayOfMonth(); //$this->FirstDayOfMonth(); //date('Y-m-d');
        $this->END_DATE = APP_UTILS::LastDayOfMonth();//$this->LastDayOfMonth(); //date('Y-m-d');
        if ($allOrders) {
            $query->andFilterWhere(['like', 'ORDER_STATUS', $this->ORDER_STATUS]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10
                ],
                'sort' => false
            ]);
        } else {
            $query->andWhere(['NOT IN', 'ORDER_STATUS', $order_status]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
                'sort' => false
            ]);
        }


        $query->orderBy(['ORDER_DATE' => SORT_DESC]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->ORDER_DATE != null && strlen($this->ORDER_DATE) > 1) {
            $date = explode("TO", $this->ORDER_DATE);

            $startDate = trim($date[0]) . ' 00:00:00';
            $endDate = trim($date[1]) . ' 23:59:59';

            $this->START_DATE = $startDate;
            $this->END_DATE = $endDate;

        }

// grid filtering conditions
        $query->andFilterWhere([
            'ORDER_ID' => $this->ORDER_ID,
            'LOCATION_ID' => $this->LOCATION_ID,
            'KITCHEN_ID' => $this->KITCHEN_ID,
            'CHEF_ID' => $this->CHEF_ID,
            'RIDER_ID' => $this->RIDER_ID,
            'USER_ID' => $this->USER_ID,
            'USER_TYPE' => $this->USER_TYPE,
            'COUNTRY_ID' => $this->COUNTRY_ID,
        ]);

        $query->andFilterWhere(['like', 'PAYMENT_METHOD', $this->PAYMENT_METHOD])
            ->andFilterWhere(['like', 'ORDER_STATUS', $this->ORDER_STATUS])
            ->andFilterWhere(['like', 'ORDER_TIME', $this->ORDER_TIME])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES])
            ->andFilterWhere(['like', 'USER_NAME', $this->USER_NAME])
            ->andFilterWhere(['like', 'SURNAME', $this->SURNAME])
            ->andFilterWhere(['like', 'OTHER_NAMES', $this->OTHER_NAMES])
            ->andFilterWhere(['like', 'LOCATION_NAME', $this->LOCATION_NAME])
            ->andFilterWhere(['like', 'CHEF_NAME', $this->CHEF_NAME]);
        //->andFilterWhere(['between', 'ORDER_DATE', $this->START_DATE, $this->END_DATE]);

        return $dataProvider;
    }

    public function OrderSearch($params, array $order_status = [])
    {
        $query = self::find();

        $this->START_DATE = APP_UTILS::FirstDayOfMonth(); //$this->FirstDayOfMonth(); //date('Y-m-d');
        $this->END_DATE = APP_UTILS::LastDayOfMonth();//$this->LastDayOfMonth(); //date('Y-m-d');

        // add conditions that should always apply here

        //$query->andWhere(['ORDER_STATUS','' => $order_status]);
        $query->andWhere(['NOT IN', 'ORDER_STATUS', $order_status]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => false
        ]);


        $query->orderBy(['ORDER_DATE' => SORT_DESC]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->ORDER_DATE != null && strlen($this->ORDER_DATE) > 1) {
            $date = explode("TO", $this->ORDER_DATE);

            $startDate = trim($date[0]) . ' 00:00:00';
            $endDate = trim($date[1]) . ' 23:59:59';

            $this->START_DATE = $startDate;
            $this->END_DATE = $endDate;

        }

        $query->andFilterWhere([
            'ORDER_STATUS' => $this->ORDER_STATUS
        ]);

        $query->andFilterWhere(['between', 'ORDER_DATE', $this->START_DATE, $this->END_DATE]);

        return $dataProvider;
    }

    public function ChefSearch($params)
    {
        $query = self::find();

        $this->START_DATE = APP_UTILS::FirstDayOfMonth(); //$this->FirstDayOfMonth(); //date('Y-m-d');
        $this->END_DATE = APP_UTILS::LastDayOfMonth();//$this->LastDayOfMonth(); //date('Y-m-d');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => false
        ]);


        $query->orderBy(['ORDER_DATE' => SORT_DESC]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->ORDER_DATE != null && strlen($this->ORDER_DATE) > 1) {
            $date = explode("TO", $this->ORDER_DATE);

            $startDate = trim($date[0]) . ' 00:00:00';
            $endDate = trim($date[1]) . ' 23:59:59';

            $this->START_DATE = $startDate;
            $this->END_DATE = $endDate;

        }

        $query->andFilterWhere([
            'CHEF_ID' => $this->CHEF_ID
        ]);

        $query->andFilterWhere(['between', 'ORDER_DATE', $this->START_DATE, $this->END_DATE]);

        return $dataProvider;
    }

    public function LocationSearch($params)
    {
        $query = self::find();

        $this->START_DATE = APP_UTILS::FirstDayOfMonth(); //$this->FirstDayOfMonth(); //date('Y-m-d');
        $this->END_DATE = APP_UTILS::LastDayOfMonth();//$this->LastDayOfMonth(); //date('Y-m-d');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => false
        ]);


        $query->orderBy(['ORDER_DATE' => SORT_DESC]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->ORDER_DATE != null && strlen($this->ORDER_DATE) > 1) {
            $date = explode("TO", $this->ORDER_DATE);

            $startDate = trim($date[0]) . ' 00:00:00';
            $endDate = trim($date[1]) . ' 23:59:59';

            $this->START_DATE = $startDate;
            $this->END_DATE = $endDate;

        }

        $query->andFilterWhere([
            'LOCATION_ID' => $this->LOCATION_ID
        ]);

        $query->andFilterWhere(['between', 'ORDER_DATE', $this->START_DATE, $this->END_DATE]);

        return $dataProvider;
    }

    public function RiderSearch($params)
    {
        $query = self::find();

        $this->START_DATE = APP_UTILS::FirstDayOfMonth(); //$this->FirstDayOfMonth(); //date('Y-m-d');
        $this->END_DATE = APP_UTILS::LastDayOfMonth();//$this->LastDayOfMonth(); //date('Y-m-d');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false,
            'pagination' => [
                'pageSize' => 150
            ],
            'sort' => false
        ]);


        $query->orderBy(['ORDER_DATE' => SORT_DESC]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->ORDER_DATE != null && strlen($this->ORDER_DATE) > 1) {
            $date = explode("TO", $this->ORDER_DATE);

            $startDate = trim($date[0]) . ' 00:00:00';
            $endDate = trim($date[1]) . ' 23:59:59';

            $this->START_DATE = $startDate;
            $this->END_DATE = $endDate;

        }

        $query->andFilterWhere([
            'RIDER_ID' => $this->RIDER_ID
        ]);

        $query->andFilterWhere(['between', 'ORDER_DATE', $this->START_DATE, $this->END_DATE]);

        return $dataProvider;
    }
}
