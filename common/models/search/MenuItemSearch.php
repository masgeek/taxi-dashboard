<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MenuItem;

/**
 * MenuItemSearch represents the model behind the search form about `common\models\MenuItem`.
 */
class MenuItemSearch extends MenuItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MENU_ITEM_ID', 'MENU_CAT_ID', 'MAX_QTY'], 'integer'],
            [['MENU_ITEM_NAME', 'MENU_ITEM_DESC', 'MENU_ITEM_IMAGE', 'IMAGE'], 'safe'],
            [['HOT_DEAL', 'VEGETARIAN'], 'boolean'],
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
        $query = MenuItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'MENU_ITEM_ID' => $this->MENU_ITEM_ID,
            'MENU_CAT_ID' => $this->MENU_CAT_ID,
            'HOT_DEAL' => $this->HOT_DEAL,
            'VEGETARIAN' => $this->VEGETARIAN,
            'MAX_QTY' => $this->MAX_QTY,
        ]);

        $query->andFilterWhere(['like', 'MENU_ITEM_NAME', $this->MENU_ITEM_NAME])
            ->andFilterWhere(['like', 'MENU_ITEM_DESC', $this->MENU_ITEM_DESC])
            ->andFilterWhere(['like', 'MENU_ITEM_IMAGE', $this->MENU_ITEM_IMAGE])
            ->andFilterWhere(['like', 'IMAGE', $this->IMAGE]);

        return $dataProvider;
    }
}
