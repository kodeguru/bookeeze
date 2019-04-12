


<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\HotelRoom */
?>


<div class="hotel-room-view">
      <!-- Default panel contents -->
      <span class="label label-sm label-success">
         <?= Html::a($model['name'], ['hotel-room/view', 'id' => $model['id']], ['class' => '', 'title'=>$model['name']]) ?>
      </span>

      <span>
        - <strong>BWP: <?= $model['cost']; ?></strong>
      </span>
      
</div>
