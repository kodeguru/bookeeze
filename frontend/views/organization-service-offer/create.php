<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrganizationServiceOffer */

$this->title = 'Create Organization Service Offer';
$this->params['breadcrumbs'][] = ['label' => 'Organization Service Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-service-offer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
