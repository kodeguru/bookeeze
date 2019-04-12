<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RentalVehicle */

$this->title = 'Update Rental Vehicle: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rental Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rental-vehicle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
