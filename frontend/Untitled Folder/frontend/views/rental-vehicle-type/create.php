<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RentalVehicleType */

$this->title = 'Create Rental Vehicle Type';
$this->params['breadcrumbs'][] = ['label' => 'Rental Vehicle Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-vehicle-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
