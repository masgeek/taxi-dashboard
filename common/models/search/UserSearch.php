<?php

namespace common\models\search;

use common\models\Users;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * common\models\search\UserSearch represents the model behind the search form about `common\models\Users`.
 */
class UserSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'allowance', 'allowance_updated_at'], 'integer'],
            [['username', 'password', 'user_type', 'account_active', 'updated_by', 'created_by', 'email'], 'safe'],
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
        $query = Users::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'allowance' => $this->allowance,
            'allowance_updated_at' => $this->allowance_updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'user_type', $this->user_type])
            ->andFilterWhere(['like', 'account_active', $this->account_active])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
