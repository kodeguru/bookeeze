<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RestaurantMenuType */

$this->title = 'Create Restaurant Menu Type';
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Menu Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-menu-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
