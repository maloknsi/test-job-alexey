<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'service_id', 'numb_serial', 'box', 'code', 'degree_wear', 'status', 'pay_type', 'pay_status', 'shipment', 'price'], 'integer'],
            [['defects', 'warning', 'date_receipt', 'date_issue'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Order::find();

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
            'user_id' => $this->user_id,
            'service_id' => $this->service_id,
            'numb_serial' => $this->numb_serial,
            'box' => $this->box,
            'code' => $this->code,
            'degree_wear' => $this->degree_wear,
            'date_receipt' => $this->date_receipt,
            'date_issue' => $this->date_issue,
            'status' => $this->status,
            'pay_type' => $this->pay_type,
            'pay_status' => $this->pay_status,
            'shipment' => $this->shipment,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'defects', $this->defects])
            ->andFilterWhere(['like', 'warning', $this->warning]);

        return $dataProvider;
    }
}
