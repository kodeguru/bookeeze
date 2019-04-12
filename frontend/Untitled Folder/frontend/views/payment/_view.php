<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'Payment No.: ' . $model->id;

?>
<div class="payment-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $controls ?>
    <?= $customer ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'invoice_id',
            // 'session_id',
            // 'customer_id',
            'due',
            'tendered',
            // 'change',
            'paymentMethod.payment_method',
            // 'payment_status',
            // 'notes',
            // 'record_status',
            [
              'attribute'=>'created_at',
              'format'=>['date', 'php:l jS F Y h:i:s A']
            ],
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
        ],
    ]) ?>

    <?= $invoice_items ?>
</div>
