<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RentalVehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="rental-vehicle-index">

    <p>
        <?= Html::a('Create Rental Vehicle', ['rental-vehicle/create', 'organization_id' => $organization_id ], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'organization_id',
            'registration_number',
            [
              'attribute' => 'type_id',
              'value' => function($model){
                return $model->type->rental_vehicle_type;
              }
            ],
            [
              'attribute' => 'make_id',
              'value' => function($model){
                return $model->make->make;
              }
            ],
            [
              'attribute' => 'model_id',
              'value' => function($model){
                return isset($model->model->model) ? $model->model->model : '';
              }
            ],
            [
              'attribute' => 'color_id',
              'value' => function($model){
                return $model->color->color;
              }
            ],
            // 'chassis',
            // 'name',
            // 'description:ntext',
            // 'picture',
            // 'cost',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
