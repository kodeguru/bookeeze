<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RentalVehicle */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rental Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-vehicle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
              'attribute' => 'organization_id',
              'format' => 'raw',
              'value' => function($model){
                $text = $model->organization->name;
                $url = ['organization/view', 'id' => $model->organization_id];
                $options = [];
                return Html::a( $text, $url, $options );
              }
            ],
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
            'chassis',
            'name',
            'description:html',
            'picture',
            'cost',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>
