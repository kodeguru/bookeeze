<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
  <div class="col-md-6">
    <div class="zurubox" id="paymentform">
      <?= $customer_partial; ?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">Payment</h3>
      </div>
      <div class="panel-body">
        <div class="payment-form" style="border:15px; padding:15px;">

          <?php $form = ActiveForm::begin([
            'id' => 'customer-payment-form',
            'options' => ['class' => 'form-horizontal'],
          ]); ?>

          <?= $form->field($payment, 'due')->textInput(['maxlength' => true]) ?>

          <?= $form->field($payment, 'tendered')->textInput(['maxlength' => true]) ?>

          <div class="form-group">
            <?= Html::submitButton('Pay', ['class' => 'btn btn-success']) ?>
          </div>

          <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
