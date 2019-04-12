<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HotelRoomType */

$this->title = 'Create Hotel Room Type';
$this->params['breadcrumbs'][] = ['label' => 'Hotel Room Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-room-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
