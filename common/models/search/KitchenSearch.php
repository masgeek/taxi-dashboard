<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kitchen;

/**
 * KitchenSearch represents the model behind the search form about `common\models\Kitchen`.
 */
class KitchenSearch extends Kitchen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KITCHEN_ID', 'CITY_ID'], 'integer'],
            [['KITCHEN_NAME', 'OPENING_TIME', 'CLOSING_TIME', 'ADDRESS'], 'safe'],
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
        $query = Kitchen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'KITCHEN_ID' => $this->KITCHEN_ID,
            'CITY_ID' => $this->CITY_ID,
            'OPENING_TIME' => $this->OPENING_TIME,
            'CLOSING_TIME' => $this->CLOSING_TIME,
        ]);

        $query->andFilterWhere(['like', 'KITCHEN_NAME', $this->KITCHEN_NAME])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS]);

        return $dataProvider;
    }
}
