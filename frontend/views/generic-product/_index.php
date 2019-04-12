<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GenericProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="generic-product-index">

    <p>
        <?= Html::a('Create Generic Product', ['generic-product/create', 'organization_id' => $organization_id], ['class' => 'btn btn-success']) ?>
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
                return $model->type->generic_product_type;
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
