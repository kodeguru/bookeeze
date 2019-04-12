<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizationServiceOfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Organization Service Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-service-offer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Organization Service Offer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'organization_id',
            'service_offer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
