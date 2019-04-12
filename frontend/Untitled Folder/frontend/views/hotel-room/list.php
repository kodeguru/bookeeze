<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HotelRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="hotel-room-index">

    <p>
      <?= Html::a('Create Hotel Room', ['hotel-room/create', 'organization_id' => $organization_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_miniview',
    ]) ?>
</div>
