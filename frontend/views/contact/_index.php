<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile(
    '@web/frontend/assets/js/script.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
    );

?>
<div class="contact-index">

  <p>
      <?= Html::a('Create Contact', ['contact/create', 'organization_id' => $organization_id], ['class' => 'btn btn-success']) ?>
  </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showHeader'=>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'organization_id',
            'type_id',
            'telephone',
            'mobilephone',
            'postal_address',
            // 'physical_address',
            // 'map_address',
            // 'country_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
