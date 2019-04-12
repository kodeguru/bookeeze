<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Reporting */
/* @var $form ActiveForm */

$this->title = 'Parameter Input';
$this->params['breadcrumbs'][] = ['label' => 'Reporting', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="reporting">
	<h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
		<?= DateRangePicker::widget([
			    'name' => 'start_date',
			    'options' => ['placeholder' => 'Select date range ...'],
			    'convertFormat' => true,
			    'pluginOptions' => [
                    'timePicker'=>false,
			        'format' => 'Y-m-d',
			        'todayHighlight' => true
			    ]
		]); ?>
        <?= $form->field($model, 'parameter') ?>
    	<?= Html::activeHiddenInput($model, 'controller_path', ['value' => $controller_path]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- reporting -->