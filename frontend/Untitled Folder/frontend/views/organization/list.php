<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_miniview',
]);

?>
