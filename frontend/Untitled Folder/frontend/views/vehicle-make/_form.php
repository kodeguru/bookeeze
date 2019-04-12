<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VehicleMake */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-make-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'make')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
