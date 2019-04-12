<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceOffer */

$this->title = 'Create Service Offer';
$this->params['breadcrumbs'][] = ['label' => 'Service Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-offer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
