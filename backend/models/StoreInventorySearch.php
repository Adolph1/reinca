<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StoreInventory;

/**
 * StoreInventorySearch represents the model behind the search form about `backend\models\StoreInventory`.
 */
class StoreInventorySearch extends StoreInventory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'store_id'], 'integer'],
            [['buying_price', 'qty'], 'number'],
            [['last_updated', 'maker_id', 'maker_time'], 'safe'],
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
        $query = StoreInventory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'buying_price' => $this->buying_price,
            'qty' => $this->qty,
            'store_id' => $this->store_id,
            'last_updated' => $this->last_updated,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
