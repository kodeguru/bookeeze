<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HotelRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotel Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hotel Room', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'organization_id',
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
            'room_type_id',
            'name',
            'description:ntext',
            // 'picture',
            // 'cost',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
