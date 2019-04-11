<?php

namespace common\models\search;

use common\models\MakeYears;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VehicleMakeYearsSearch represents the model behind the search form about `common\models\MakeYears`.
 */
class VehicleMakeYearsSearch extends MakeYears
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'year', 'make_id', 'created_at', 'updated_at'], 'integer'],
            [['updated_by', 'created_by', 'slug'], 'safe'],
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
        $query = MakeYears::find();

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
            'year' => $this->year,
            'make_id' => $this->make_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
