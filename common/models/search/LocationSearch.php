<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Location;

/**
 * LocationSearch represents the model behind the search form about `common\models\Location`.
 */
class LocationSearch extends Location
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LOCATION_ID', 'CITY_ID'], 'integer'],
            [['LOCATION_NAME', 'ADDRESS'], 'safe'],
            [['ACTIVE'], 'boolean'],
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
        $query = Location::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'LOCATION_ID' => $this->LOCATION_ID,
            'CITY_ID' => $this->CITY_ID,
            'ACTIVE' => $this->ACTIVE,
        ]);

        $query->andFilterWhere(['like', 'LOCATION_NAME', $this->LOCATION_NAME])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS]);

        return $dataProvider;
    }
}
