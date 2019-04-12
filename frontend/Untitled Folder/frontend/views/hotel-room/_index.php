<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HotelRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="hotel-room-index">
    <p>
        <?= Html::a('Create Hotel Room', ['hotel-room/create', 'organization_id' => $organization_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // [
            //   'attribute' => 'organization_id',
            //   'value' => function($model){
            //     return $model->organization->name;
            //   }
            // ],
            [
              'attribute' => 'room_type_id',
              'value' => function($model){
                return $model->roomType->type;
              }
            ],
            'name',
            'description:html',
            'picture',
            'cost',
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
