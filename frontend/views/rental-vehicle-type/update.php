<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RentalVehicleType */

$this->title = 'Update Rental Vehicle Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rental Vehicle Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rental-vehicle-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
