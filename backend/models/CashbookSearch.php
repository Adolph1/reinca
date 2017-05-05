<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Cashbook;

/**
 * CashbookSearch represents the model behind the search form about `backend\models\Cashbook`.
 */
class CashbookSearch extends Cashbook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['trn_dt', 'drcr_ind', 'description', 'maker_id', 'maker_time', 'auth_status', 'checker_id', 'checker_time'], 'safe'],
            [['amount'], 'number'],
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
        $query = Cashbook::find();

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
            'amount' => $this->amount,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'drcr_ind', $this->drcr_ind])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'auth_status', $this->auth_status])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }
}
