<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Adjustment;

/**
 * AdjustmentSearch represents the model behind the search form about `backend\models\Adjustment`.
 */
class AdjustmentSearch extends Adjustment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transfered_good_id'], 'integer'],
            [['total_qty', 'adjusted_stock', 'transfered_qty'], 'number'],
            [['maker_id', 'maker_time'], 'safe'],
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
        $query = Adjustment::find();

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
            'transfered_good_id' => $this->transfered_good_id,
            'total_qty' => $this->total_qty,
            'adjusted_stock' => $this->adjusted_stock,
            'transfered_qty' => $this->transfered_qty,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }

    /*
     * filters adjusts
     */
    public function searchbyId($params)
    {
        $query = Adjustment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        // grid filtering conditions
        $query->andFilterWhere([
            'transfered_good_id' => $params

        ]);


        return $dataProvider;
    }
}
