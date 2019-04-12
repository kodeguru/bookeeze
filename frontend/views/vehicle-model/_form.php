<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VehicleModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'make_id')->textInput() ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
