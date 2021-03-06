<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductItemStatus */

$this->title = 'Create Product Item Status';
$this->params['breadcrumbs'][] = ['label' => 'Product Item Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-item-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
