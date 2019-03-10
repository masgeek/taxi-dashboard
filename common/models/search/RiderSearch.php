<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Riders;

/**
 * RiderSearch represents the model behind the search form about `common\models\Riders`.
 */
class RiderSearch extends Riders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RIDER_ID', 'USER_ID', 'KITCHEN_ID'], 'integer'],
            [['RIDER_STATUS'], 'boolean'],
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
        $query = Riders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'RIDER_ID' => $this->RIDER_ID,
            'USER_ID' => $this->USER_ID,
            'KITCHEN_ID' => $this->KITCHEN_ID,
            'RIDER_STATUS' => $this->RIDER_STATUS,
        ]);

        return $dataProvider;
    }
}
