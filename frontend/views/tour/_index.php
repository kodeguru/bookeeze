<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="tour-index">

    <p>
        <?= Html::a('Create Tour', ['tour/create', 'organization_id' => $organization_id ], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
              'attribute' => 'type_id',
              'value' => function($model){
                return $model->type->type;
              }
            ],
            'name',
            'description:html',
            'cost',
            // 'picture',
            // 'cost',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open showModalButton"></span>', $url, [
                                    'title' => Yii::t('app', 'View'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil showModalButton"></span>', $url, [
                                    'title' => Yii::t('app', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash showModallButton"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-method' => 'POST',
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = Yii::$app->urlManager->createUrl(['/tour/view', 'id' => $model->id]);
                        return $url;
                    }
                    if ($action === 'update') {
                        $url = Yii::$app->urlManager->createUrl(['/tour/update', 'id' => $model->id ]);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = Yii::$app->urlManager->createUrl(['/tour/delete', 'id' => $model->id]);
                        return $url;
                    }
                }

            ],


        ],
    ]); ?>
</div>
