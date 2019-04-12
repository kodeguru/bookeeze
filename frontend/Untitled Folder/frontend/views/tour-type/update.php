<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TourType */

$this->title = 'Update Tour Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tour Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tour-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
