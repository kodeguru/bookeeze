<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'My Business';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="organization-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_miniview',
    ]);
    ?>

</div>
