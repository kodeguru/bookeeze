<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationServiceOffer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-service-offer-form">

<?php

Pjax::begin();

$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id'=>$model->formName(), ]);
echo FormGrid::widget([
    'model'=>$model,
    'form'=>$form,
    'autoGenerateColumns'=>true,
    'rows'=>[
        [
            'attributes'=>[       // 4 column layout
                'service_offer_id'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>['data'=>\app\models\ServiceOffer::getServiceOfferList(),
                            'pluginOptions' => [
		                        'placeholder' => 'Select a service offer ...',
                                'allowClear' => true,
	                            'multiple' => true,
                            ]],
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
        ],
    ],
]);
ActiveForm::end();

Pjax::end();
?>

</div>
