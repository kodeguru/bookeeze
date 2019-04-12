<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RestaurantMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="restaurant-menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Restaurant Menu', ['restaurant-menu/create', 'organization_id' => $organization_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // [
            //   'attribute' => 'organization_id',
            //   'format' => 'raw',
            //   'value' => function($model){
            //     $text = $model->organization->name;
            //     $url = ['organization/view', 'id' => $model->organization_id];
            //     $options = [];
            //     return Html::a( $text, $url, $options );
            //   }
            // ],
            [
              'attribute' => 'type_id',
              'value' => function($model){
                return $model->type->type;
              }
            ],
            'name',
            'description:html',
            // 'picture',
            // 'cost',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
