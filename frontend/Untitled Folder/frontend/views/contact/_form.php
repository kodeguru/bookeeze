<?php

use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

<?php
  $form = ActiveForm::begin();
  echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
      'rows' => [
          [
              'attributes' => [
                  'type_id'=>[
                          'type'=>Form::INPUT_WIDGET,
                          'widgetClass'=>'\kartik\widgets\Select2',
                          'options'=>[
                              'data'=>\app\models\ContactType::getContactTypeList(),
                              'pluginOptions' => [
                                  'allowClear' => true,
                                  'placeholder'=>'Select...',
                                ],
                          ],
                      ],
              ],
          ],
          [
              'attributes' => [
                  'telephone' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter telephone...']],
                  'mobilephone' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter mobile phone...']],
              ],
          ],
          [
              'attributes' => [
                  'website' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter website...']],
                  'email_address' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter email address...']],
              ],
          ],
          [
              'attributes' => [
                  'postal_address' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter postal address...']],
                  'physical_address' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter physical address...']],
                  'map_address' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter map_address...']],
              ]
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
