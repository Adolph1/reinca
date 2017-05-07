<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TransferedGood;

/**
 * TransferedGoodSearch represents the model behind the search form about `backend\models\TransferedGood`.
 */
class TransferedGoodSearch extends TransferedGood
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_id','status'], 'integer'],
            [['transfer_date', 'horse_number', 'trailer_number', 'driver_name', 'driver_phonenumber'], 'safe'],
            [['qty', 'balance'], 'number'],
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
        $query = TransferedGood::find();

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
            'transfer_date' => $this->transfer_date,
            'store_id' => $this->store_id,
            'qty' => $this->qty,
            'balance' => $this->balance,
        ]);

        $query->andFilterWhere(['like', 'horse_number', $this->horse_number])
            ->andFilterWhere(['like', 'trailer_number', $this->trailer_number])
            ->andFilterWhere(['like', 'driver_name', $this->driver_name])
            ->andFilterWhere(['like', 'driver_phonenumber', $this->driver_phonenumber]);

        return $dataProvider;
    }

    public function pending($params)
    {
        $query = TransferedGood::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        // grid filtering conditions
        $query->andFilterWhere([
            'status' => TransferedGood::PENDING,

        ]);

        return $dataProvider;
    }

    public function received($params)
    {
        $query = TransferedGood::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        // grid filtering conditions
        $query->andFilterWhere([
            'status' => TransferedGood::RECEIVED,

        ]);

        return $dataProvider;
    }

    public function canceled($params)
    {
        $query = TransferedGood::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        // grid filtering conditions
        $query->andFilterWhere([
            'status' => TransferedGood::CANCELED,

        ]);

        return $dataProvider;
    }
}
