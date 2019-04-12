<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoiceItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
?>
<div class="invoice-item-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'invoice_id',
            [
              'attribute'=>'product_item_id',
              'value'=>'productItem.description',
              'format'=>'html',
            ],
            // 'description:ntext',
            'quantity',
            'unit_cost',
            'total',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
