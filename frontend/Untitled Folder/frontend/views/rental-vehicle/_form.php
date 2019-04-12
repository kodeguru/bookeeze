<?php

use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RentalVehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rental-vehicle-form">

<?php
  $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]);
  echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
      'rows' => [
          [
              'attributes' => [
                  'type_id' => [
                                  'type'=>Form::INPUT_WIDGET,
                                  'widgetClass'=>'\kartik\widgets\Select2',
                                  'options'=>[
                                      'data'=>\app\models\RentalVehicleType::getRentalVehicleTypeList(),
                                      'pluginOptions' => [
                                          'allowClear' => true,
                                          'placeholder'=>'Select...',
                                        ],
                      ],
                  ],
                  'registration_number' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter mobile phone...']],
                  // 'name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter name...']],
                  'cost' => [
                            'type'=>Form::INPUT_WIDGET,
                            'widgetClass'=>'\kartik\touchspin\TouchSpin',
                            'options'=>[
                                'pluginOptions' => [
                                    'min' => 0,
                                    'max' => 1000000,
                                    'decimals' => 2,
                                  ],
                            ],
                  ],
              ],
          ],
          [
              'attributes' => [
                  'chassis' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter chassis number...']],
                  'make_id' => [
                                  'type'=>Form::INPUT_WIDGET,
                                  'widgetClass'=>'\kartik\widgets\Select2',
                                  'options'=>[
                                      'data'=>\app\models\VehicleMake::getVehicleMakeList(),
                                      'pluginOptions' => [
                                          'allowClear' => true,
                                          'placeholder'=>'Select...',
                                        ],
                                  ],
                  ],
                  'model_id' => [
                                  'type'=>Form::INPUT_WIDGET,
                                  'widgetClass'=>'\kartik\widgets\Select2',
                                  'options'=>[
                                      'data'=>\app\models\VehicleModel::getVehicleModelList(),
                                      'pluginOptions' => [
                                          'allowClear' => true,
                                          'placeholder'=>'Select...',
                                        ],
                                  ],
                  ],
                  'color_id' => [
                                  'type'=>Form::INPUT_WIDGET,
                                  'widgetClass'=>'\kartik\widgets\Select2',
                                  'options'=>[
                                      'data'=>\app\models\Color::getColorList(),
                                      'pluginOptions' => [
                                          'allowClear' => true,
                                          'placeholder'=>'Select...',
                                        ],
                                  ],
                  ],
              ],
          ],
          [
            'attributes'=>[       // 1 column layout
                'description'=>[
                  'type'=>Form::INPUT_WIDGET,
                  'widgetClass'=>'\yii\redactor\widgets\Redactor',
                  'clientOptions' => [
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    // 'lang' => 'zh_cn',
                    'plugins' => ['clips', 'fontcolor','imagemanager']
                  ],
                ],
              ],
          ],
          [
              'attributes' => [
                  'picture'=> [
                      'type'=>Form::INPUT_WIDGET,
                      'widgetClass'=>'\kartik\widgets\FileInput',
                          'options'=>[
                           'pluginOptions' => [
                             'showUpload' => true,
                             'showCaption' => false,
                             'browseClass' => "btn btn-primary btn-lg",
                             'fileType' => "any",
                             'previewFileIcon' => "<i class='glyphicon glyphicon-king'></i>",
                             'overwriteInitial' => false,
                             'initialPreviewAsData' => true,
                             'accept' => 'image/*'
                           ]
                          ]
                      ],
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
