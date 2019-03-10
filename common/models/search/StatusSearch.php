<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Status;

/**
 * StatusSearch represents the model behind the search form about `common\models\Status`.
 */
class StatusSearch extends Status
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STATUS_NAME', 'STATUS_DESC', 'COLOR', 'SCOPE'], 'safe'],
            [['RANK', 'WORKFLOW'], 'integer'],
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
        $query = Status::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'RANK' => $this->RANK,
            'WORKFLOW' => $this->WORKFLOW,
        ]);

        $query->andFilterWhere(['like', 'STATUS_NAME', $this->STATUS_NAME])
            ->andFilterWhere(['like', 'STATUS_DESC', $this->STATUS_DESC])
            ->andFilterWhere(['like', 'COLOR', $this->COLOR])
            ->andFilterWhere(['like', 'SCOPE', $this->SCOPE]);

        return $dataProvider;
    }
}
