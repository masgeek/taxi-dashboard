<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UserSearch represents the model behind the search form about `common\models\Users`.
 */
class UserSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USER_ID', 'USER_TYPE', 'LOCATION_ID'], 'integer'],
            [['USER_NAME', 'SURNAME', 'OTHER_NAMES', 'MOBILE', 'EMAIL', 'PASSWORD', 'DATE_REGISTERED', 'LAST_UPDATED', 'CLIENT_TOKEN', 'RESET_TOKEN', 'TOKEN_EXPPIRY'], 'safe'],
            [['USER_STATUS'], 'boolean'],
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
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'USER_ID' => $this->USER_ID,
            'USER_TYPE' => $this->USER_TYPE,
            'LOCATION_ID' => $this->LOCATION_ID,
            'DATE_REGISTERED' => $this->DATE_REGISTERED,
            'LAST_UPDATED' => $this->LAST_UPDATED,
            'USER_STATUS' => $this->USER_STATUS,
            'TOKEN_EXPPIRY' => $this->TOKEN_EXPPIRY,
        ]);

        $query->andFilterWhere(['like', 'USER_NAME', $this->USER_NAME])
            ->andFilterWhere(['like', 'SURNAME', $this->SURNAME])
            ->andFilterWhere(['like', 'OTHER_NAMES', $this->OTHER_NAMES])
            ->andFilterWhere(['like', 'MOBILE', $this->MOBILE])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'PASSWORD', $this->PASSWORD])
            ->andFilterWhere(['like', 'CLIENT_TOKEN', $this->CLIENT_TOKEN])
            ->andFilterWhere(['like', 'RESET_TOKEN', $this->RESET_TOKEN]);

        return $dataProvider;
    }
}
