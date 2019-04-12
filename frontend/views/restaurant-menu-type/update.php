<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RestaurantMenuType */

$this->title = 'Update Restaurant Menu Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Menu Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="restaurant-menu-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
