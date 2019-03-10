<?php

namespace common\models\search;

use common\helper\APP_UTILS;
use common\helper\OrderHelper as ORDER_HELPER;
use common\models\VwPizzaSalesReports;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PizzaReportSearch represents the model behind the search form of `app\model_extended\PizzaReportModel`.
 */
class PizzaReportSearch extends VwPizzaSalesReports
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ORDER_ID', 'LOCATION_ID', 'KITCHEN_ID', 'CHEF_ID', 'RIDER_ID', 'USER_ID', 'USER_TYPE', 'COUNTRY_ID', 'QUANTITY', 'MENU_ITEM_ID', 'MENU_CAT_ID', 'ITEM_TYPE_ID'], 'integer'],
            [['ORDER_DATE', 'MENU_ITEM_NAME', 'MENU_ITEM_DESC', 'MENU_CAT_NAME', 'ITEM_TYPE_SIZE', 'START_DATE', 'END_DATE'], 'safe'],
            [['PRICE'], 'number'],
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

    public function PizzaSearch($params, array $order_status = [])
    {
        $order_status = [
            ORDER_HELPER::STATUS_ORDER_CANCELLED,
            ORDER_HELPER::STATUS_ORDER_PENDING,
            ORDER_HELPER::STATUS_PAYMENT_PENDING,
        ];
        $query = self::find();

        $this->START_DATE = APP_UTILS::FirstDayOfMonth(); //$this->FirstDayOfMonth(); //date('Y-m-d');
        $this->END_DATE = APP_UTILS::LastDayOfMonth();//$this->LastDayOfMonth(); //date('Y-m-d');

        // add conditions that should always apply here

        //$query->andWhere(['ORDER_STATUS','' => $order_status]);
        $query->andWhere(['NOT IN', 'ORDER_STATUS', $order_status]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => false,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => false
        ]);

        $query->orderBy(['ORDER_ID' => SORT_DESC]);
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
            'MENU_ITEM_NAME' => $this->MENU_ITEM_NAME,
            'ITEM_TYPE_SIZE' => $this->ITEM_TYPE_SIZE,
            'MENU_CAT_NAME' => $this->MENU_CAT_NAME,
            'PAYMENT_METHOD' => $this->PAYMENT_METHOD,
        ]);

        $query->andFilterWhere(['between', 'ORDER_DATE', $this->START_DATE, $this->END_DATE]);

        return $dataProvider;
    }
}
