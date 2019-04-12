<?php

use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-item-form">

<?php
  $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]);
  echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
      'rows' => [
          [
              'attributes' => [
                  'description' => [
                    'type'=>Form::INPUT_STATIC,
                    'options'=>[
                        'readonly'=>'readonly',
                        ],
                    ],
                  'quantity' => [
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'\kartik\touchspin\TouchSpin',
                    'options'=>[
                      'readonly'=>'readonly',
                      
                        'pluginOptions' => [
                                'allowClear' => true,
                                'step' => 1,
                                'decimals'=>0,
                            ],
                        ],
                    ],
                  'unit_cost' => [
                    'type'=>Form::INPUT_TEXT,
                    'options'=>[
                        'readonly'=>'readonly',
                        ],
                    ],
                  'total' => [
                    'type'=>Form::INPUT_TEXT,
                    'options'=>[
                        'readonly'=>'readonly',
                        ],
                    ],
              ],
          ],
          [
              'attributes'=>[
                  'actions'=>[    // embed raw HTML content
                      'type'=>Form::INPUT_RAW,
                      'value'=>  '<div style="text-align: right; margin-top: 20px">' .
                          Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                          Html::submitButton('Submit', ['class'=>'btn btn-primary']) .
                          '</div>'
                  ],
               ],
          ]
      ]
  ]);
  ActiveForm::end();

?>

</div>

<?php
$this->registerJs("
    $('#orderitem-quantity').change(function(){
        var unit_cost = $('#orderitem-unit_cost').val(),
            quantity = $('#orderitem-quantity').val(),
            total = 0;

            total = total - 0; // convert to int
            unit_cost = unit_cost - 0; // convert to int
            quantity = quantity - 0; // convert to int

            total = unit_cost * quantity;

        $('#orderitem-total').val(total.toFixed(2));
    });
");
?>
