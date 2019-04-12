<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvoiceStatus */

$this->title = 'Create Invoice Status';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
