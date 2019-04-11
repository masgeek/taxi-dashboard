<?php

namespace common\models\search;

use common\models\Vehicles;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VehiclesSearch represents the model behind the search form about `common\models\Vehicles`.
 */
class VehiclesSearch extends Vehicles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'model_id', 'capacity', 'color', 'active', 'created_at', 'updated_at'], 'integer'],
            [['mileage', 'total_distance'], 'number'],
            [['reg_no', 'reg_year', 'updated_by', 'created_by', 'slug'], 'safe'],
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
        $query = Vehicles::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'model_id' => $this->model_id,
            'capacity' => $this->capacity,
            'color' => $this->color,
            'mileage' => $this->mileage,
            'total_distance' => $this->total_distance,
            'reg_year' => $this->reg_year,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'reg_no', $this->reg_no])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
