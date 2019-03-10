<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Chef;

/**
 * ChefSearch represents the model behind the search form about `common\models\Chef`.
 */
class ChefSearch extends Chef
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CHEF_ID', 'KITCHEN_ID'], 'integer'],
            [['CHEF_NAME'], 'safe'],
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
        $query = Chef::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'CHEF_ID' => $this->CHEF_ID,
            'KITCHEN_ID' => $this->KITCHEN_ID,
        ]);

        $query->andFilterWhere(['like', 'CHEF_NAME', $this->CHEF_NAME]);

        return $dataProvider;
    }
}
