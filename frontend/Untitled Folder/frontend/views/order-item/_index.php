<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shopping Cart Items';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'order_id',
            // 'product_item_id',
            'description:html',
            'quantity',
            'unit_cost',
            'total',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete}',
               'buttons' => [
                   'delete' => function ($url, $model) {
                       return Html::a('<span class="glyphicon glyphicon-trash showModallButton"></span>', $url, [
                                   'title' => Yii::t('app', 'Delete'),
                                   'data-method' => 'POST',
                       ]);
                   }
               ],
               'urlCreator' => function ($action, $model, $key, $index) {
                   if ($action === 'delete') {
                       $url = Yii::$app->urlManager->createUrl(['/order-item/delete', 'id' => $model->id]);
                       return $url;
                   }
               }

           ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
