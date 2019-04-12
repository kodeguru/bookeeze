
<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HotelRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="hotel-room-index">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'summary'=>'',
        'itemView' => '_viewroom',
    ]) ?>
</div>



