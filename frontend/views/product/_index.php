<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="product-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'parent_id',
            // 'generic_product_id',
            // 'rental_vehicle_id',
            'hotel_room_id',
            // 'tour_id',
            // 'restaurant_menu_id',
            'name',
            // 'description:ntext',
            // 'unit_cost',
            // 'quantity',
            // 'total_sold',
            // 'total_reserved',
            // 'total_remaining',
            'start_date',
            'end_date',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
