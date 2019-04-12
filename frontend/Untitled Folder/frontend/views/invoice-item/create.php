<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvoiceItem */

$this->title = 'Create Invoice Item';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
