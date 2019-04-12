<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile(
    '@web/frontend/assets/js/script.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
    );

?>
<div class="organization-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showOnEmpty' => false,
        'layout' => '{items}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // [
            //   'attribute' => 'parent_id',
            //   'format' => 'raw',
            //   'value' => function($model){
            //     if($name = isset($model->parent->name)){
            //       $name = $model->parent->name;
            //       $url = Html::a($name, ['view', 'id' => $model->parent_id], ['class' => 'btn btn-primary']);
            //       return $url;
            //     }
            //   },
            //   'visible' => isset($model->parent->name),
            // ],
            // [
            //   'attribute' => 'type_id',
            //   'value' => function($model){
            //     return $model->type->type;
            //   }
            // ],
            // 'type_id',
            [
                'label'=>'Branch',
                'format'=>'raw',
                'value' =>  function ($model){
                   return Html::a($model->name, ['organization/view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                }
            ],
            // 'name',
            // 'description:html',
            // 'logo',
            // 'picture',
            // 'logo',
            // 'picture',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
