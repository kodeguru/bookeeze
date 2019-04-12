<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HotelRoom */

$this->title = $model->organization->name . " - " . $model->name ;
$this->params['breadcrumbs'][] = ['label' => 'Hotel Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-room-view">
    <div class="card-box">
        <div class="card-head"> 
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    
    <div class="card-body ">
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
        <div class="row">
            <div class="col-sm-4">
                 <img src="<?= $model->picture ?>" alt="<i class='fa fa-ticket'> Bookeezz!</i>" class="img-thumbnail thumbnail" style="height: 200px; width: auto; display: block;">
            </div>
            <div class="col-sm-8">

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
                        [
                          'attribute' => 'room_type_id',
                          'value' => function($model){
                            return $model->roomType->type;
                          }
                        ],
                        'name',
                        //'description:html',
                        'cost',
                        // 'created_at',
                        // 'updated_at',
                        // 'created_by',
                        // 'updated_by',
                    ],
                ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $model->description ?>
        </div>
    </div>

</div>
</div>
