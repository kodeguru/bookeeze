<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'Hotels';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="organization-listing">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_minilisting',
    ]);
    ?>

</div>
