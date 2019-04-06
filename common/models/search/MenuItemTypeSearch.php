<?php

namespace common\models\search;

use common\models\MenuItemType;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MenuItemTypeSearch represents the model behind the search form about `common\models\MenuItemType`.
 */
class MenuItemTypeSearch extends MenuItemType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_TYPE_ID', 'MENU_ITEM_ID'], 'integer'],
            [['ITEM_TYPE_SIZE'], 'safe'],
            [['PRICE'], 'number'],
            [['AVAILABLE'], 'boolean'],
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
        $query = MenuItemType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ITEM_TYPE_ID' => $this->ITEM_TYPE_ID,
            'MENU_ITEM_ID' => $this->MENU_ITEM_ID,
            'PRICE' => $this->PRICE,
            'AVAILABLE' => $this->AVAILABLE,
        ]);

        $query->andFilterWhere(['like', 'ITEM_TYPE_SIZE', $this->ITEM_TYPE_SIZE]);

        return $dataProvider;
    }
}
