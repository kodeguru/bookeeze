<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RentalVehicle */

$this->title = 'Create Rental Vehicle';
$this->params['breadcrumbs'][] = ['label' => 'Rental Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-vehicle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
