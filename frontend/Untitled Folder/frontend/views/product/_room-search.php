<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Reservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
  <div class="panel-body">
    <div class="reservation-form"  >

    <?php

    Pjax::begin();

    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'enctype'=>'multipart/form-data',
            'data-pjax' => 1
        ],
    ]);

    echo FormGrid::widget([
        'model'=>$model,
        'form'=>$form,
        'autoGenerateColumns'=>true,
        'rows'=>[
            [
                'attributes'=>[       // 4 column layout
                    'location_id' => [
                      'type'=>Form::INPUT_WIDGET,
                      'widgetClass'=>'\kartik\widgets\Select2',
                      'options'=>[
                        'pluginOptions' => [
                          'allowClear' => true
                        ],
                        'data'=>\app\models\Location::getLocationList(),
                      ],
                    ],
                    'check_in_out_date'=>[
                            'type'=>Form::INPUT_WIDGET,
                            'widgetClass'=>'\kartik\daterange\DateRangePicker',
                            'options' => [
                                'convertFormat'=>true,
                                'pluginOptions' => [
                                    'timePicker'=>true,
                                    'timePickerIncrement'=>15,
                                    'locale'=>['format'=>'Y-m-d H:i'],
                                    'locale'=>['format'=>'Y-m-d H:i'],
                                    'timePicker24Hour' => true,
                                    'todayHighlight' => true,
                                ]],
                            ],
                    'room_type_id'=>[
                      'type'=>Form::INPUT_WIDGET,
                      'widgetClass'=>'\kartik\widgets\Select2',
                      'options'=>[
                        'pluginOptions' => [
                          'allowClear' => true
                        ],
                        'data'=>\app\models\HotelRoomType::getHotelRoomTypeList(),
                      ],
                    ],
                    'actions'=>[    // embed raw HTML content
                        'type'=>Form::INPUT_RAW,
                        'value'=>  '<div style="text-align: right; margin-top: 20px">' .
                            Html::submitButton('Submit', ['class'=>'btn btn-primary']) . ' ' .
                            Html::a('Reset', ['index'], ['class'=>'btn btn-default']) .
                            '</div>'
                    ],
                ]
            ],
        ],
    ]);
    ActiveForm::end();

    Pjax::end();
    ?>

    </div>
  </div>
</div>


<div id="search-results" class="content-box col-sm-12"></div>

<?php
$this->registerJs("
$(function(){
        $('#productsearch-check_in_out_date').change(function(){
            $('#search-results').show();
            $.ajax({
               url: '/product/available-room',
               type: 'POST',
               data: { check_in_out_date: $('#productsearch-check_in_out_date').val() },
               success: function(data) {
                 // process data
                 $('#search-results').html(data);
               }
            });

        });
    });
");
?>
