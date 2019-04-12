<?php
use yii\widgets\ListView;
?>
<div class="hotel-room-list">

  <?= ListView::widget([
  'dataProvider' => $dataProvider,
  'layout' => "{summary}\n{pager}\n{items}",
  'itemView' => '_view',
  // 'viewParams' => ['product_id' => function ($model, $key, $index, $widget){ return $product_ids[$index]; }],
  ]); ?>

</div>
