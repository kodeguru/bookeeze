<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pos;

/**
 * PosSearch represents the model behind the search form of `app\models\Pos`.
 */
class PosSearch extends Pos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'organization_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['session_id', 'start_date', 'end_date', 'record_status'], 'safe'],
            [['opening_balance', 'closing_balance', 'total_orders', 'total_invoices', 'total_payments', 'total_refunds'], 'number'],
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
        $query = Pos::find();

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
            'organization_id' => $this->organization_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'opening_balance' => $this->opening_balance,
            'closing_balance' => $this->closing_balance,
            'total_orders' => $this->total_orders,
            'total_invoices' => $this->total_invoices,
            'total_payments' => $this->total_payments,
            'total_refunds' => $this->total_refunds,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
            ->andFilterWhere(['like', 'record_status', $this->record_status]);

        return $dataProvider;
    }
}
