<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">
  <div class="zurubox" id="paymentform">

    <?php $form = ActiveForm::begin([
        'id' => 'customer-payment-form',
        'options' => ['class' => 'form-horizontal'],
    ]); ?>


      <?= $form->field($customer, 'fullname')->textInput(['maxlength' => true]) ?>

      <?= $form->field($customer, 'phone')->textInput(['maxlength' => true]) ?>

      <?= $form->field($customer, 'mobile')->textInput(['maxlength' => true]) ?>

      <?= $form->field($customer, 'email')->textInput(['maxlength' => true]) ?>

      <?= $form->field($customer, 'address')->textInput(['maxlength' => true]) ?>

      <?= $form->field($customer, 'physical')->textInput(['maxlength' => true]) ?>

      <?= $form->field($customer, 'country_id')->widget(Select2::classname(), [
        'data' => \app\models\Country::getCountryList(),
        'language' => 'en',
        'options' => ['placeholder' => 'Select country ...'],
        'pluginOptions' => [
          'allowClear' => true
        ],
      ]); ?>

    <?= $form->field($payment, 'due')->textInput(['maxlength' => true]) ?>

    <?= $form->field($payment, 'tendered')->textInput(['maxlength' => true]) ?>

    <?= $form->field($payment, 'change')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

  </div>
</div>
