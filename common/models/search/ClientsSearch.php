<?php

namespace common\models\search;

use common\models\Clients;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * common\models\search\ClientsSearch represents the model behind the search form about `common\models\Clients`.
 */
class ClientsSearch extends Clients
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'client_type', 'email', 'mobile', 'landline', 'currency', 'updated_by', 'created_by', 'slug'], 'safe'],
            [['base_charge', 'min_charge', 'waiting_charge'], 'number'],
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
        $query = Clients::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'base_charge' => $this->base_charge,
            'min_charge' => $this->min_charge,
            'waiting_charge' => $this->waiting_charge,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'client_type', $this->client_type])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'landline', $this->landline])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
