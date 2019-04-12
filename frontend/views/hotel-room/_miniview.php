<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HotelRoom */
?>

<div class="hotel-room-view col-xs-12 col-sm-12 col-md-4 col-lg-4">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <strong><?= $model['name']; ?></strong>
      </div>
        <div class="panel-body">

        <?php
          $name = $model['name'];
          $picture = $model['picture'];
          $cost = $model['cost'];

          $content = "<p class=\"thumbnail\">";
          $content .= "<img src=\"$picture\" alt=\"<i class='fa fa-ticket'> Bookeezz!</i>\" class=\"img-thumbnail\" style=\"height: 200px; width: auto; display: block;\">";
          $content .= "</p>";
        ?>

        <?= Html::a($content, ['hotel-room/view', 'id' => $model['id']], ['class' => 'panel panel-default', 'title'=>$name]) ?>

      </div>

      <div class="panel-footer">
        <strong>BWP: <?= $model['cost']; ?></strong>
      </div>
    </div>

</div>
