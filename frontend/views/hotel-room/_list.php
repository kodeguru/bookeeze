<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = "Search Results";
?>

<h3><?= Html::encode($this->title) ?></h3>
<div class="hotel-room-list">

  <?= ListView::widget([
  'dataProvider' => $dataProvider,
  'layout' => "{summary}\n{pager}\n{items}",
  'itemView' => '_view',
  // 'viewParams' => ['product_id' => function ($model, $key, $index, $widget){ return $product_ids[$index]; }],
  ]); ?>

</div>
