<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VehicleModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicle Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vehicle Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'make.make',
            'model',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
