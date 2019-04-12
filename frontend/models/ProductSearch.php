<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'generic_product_id', 'rental_vehicle_id', 'hotel_room_id', 'tour_id', 'restaurant_menu_id', 'quantity', 'total_sold', 'total_reserved', 'total_remaining', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description', 'start_date', 'end_date'], 'safe'],
            [['unit_cost'], 'number'],
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
        $query = Product::find();

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
            'parent_id' => $this->parent_id,
            'generic_product_id' => $this->generic_product_id,
            'rental_vehicle_id' => $this->rental_vehicle_id,
            'hotel_room_id' => $this->hotel_room_id,
            'tour_id' => $this->tour_id,
            'restaurant_menu_id' => $this->restaurant_menu_id,
            'unit_cost' => $this->unit_cost,
            'quantity' => $this->quantity,
            'total_sold' => $this->total_sold,
            'total_reserved' => $this->total_reserved,
            'total_remaining' => $this->total_remaining,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
