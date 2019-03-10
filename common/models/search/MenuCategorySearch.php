<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MenuCategory;

/**
 * MenuCategorySearch represents the model behind the search form about `common\models\MenuCategory`.
 */
class MenuCategorySearch extends MenuCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MENU_CAT_ID', 'ACTIVE', 'RANK'], 'integer'],
            [['MENU_CAT_NAME', 'MENU_CAT_IMAGE'], 'safe'],
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
        $query = MenuCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'MENU_CAT_ID' => $this->MENU_CAT_ID,
            'ACTIVE' => $this->ACTIVE,
            'RANK' => $this->RANK,
        ]);

        $query->andFilterWhere(['like', 'MENU_CAT_NAME', $this->MENU_CAT_NAME])
            ->andFilterWhere(['like', 'MENU_CAT_IMAGE', $this->MENU_CAT_IMAGE]);

        return $dataProvider;
    }
}
