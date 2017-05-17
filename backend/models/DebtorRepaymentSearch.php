<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DebtorRepayment;

/**
 * DebtorRepaymentSearch represents the model behind the search form about `backend\models\DebtorRepayment`.
 */
class DebtorRepaymentSearch extends DebtorRepayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'debtor_id'], 'integer'],
            [['trn_dt', 'maker_id', 'maker_time'], 'safe'],
            [['amount', 'balance'], 'number'],
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
        $query = DebtorRepayment::find();

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
            'trn_dt' => $this->trn_dt,
            'debtor_id' => $this->debtor_id,
            'amount' => $this->amount,
            'balance' => $this->balance,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }

    /*
     * filters debtor transactions
     */
    public function searchbyId($params)
    {
        $query = DebtorRepayment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        // grid filtering conditions
        $query->andFilterWhere([
            'debtor_id' => $params

        ]);


        return $dataProvider;
    }
}
