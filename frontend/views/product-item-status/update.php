<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductItemStatus */

$this->title = 'Update Product Item Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Item Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-item-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
