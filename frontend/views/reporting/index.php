<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Standard Reports';

?>
<h3><?= Html::encode($this->title) ?></h3>

<div class="row">
  <div class="col-md-6">
	<div class="list-group">
  	    <?= Html::a('<i class="fa fa-music"> Events</i>', ['#'],
			[	
			'class' => 'list-group-item active',
			]) ?>
  		<?= Html::a('<i class="fa fa-music"> All Events</i>', ['/event/list-report'],
			[	
			'class' => 'list-group-item ',
        	'target'=> '_blank',
			'title'=> Yii::t('app', 'All Events'),
			]) ?>			

  		<?= Html::a('<i class="fa fa-ticket"> Event Orders</i>', ['/event/orders-report'],
			[	
			'class' => 'list-group-item ',
        	'target'=> '_blank',
			'title'=> Yii::t('app', 'Event Takings'),
			]) ?>

  		<?= Html::a('<i class="fa fa-ticket"> Event Takings</i>', ['/event/takings-report'],
			[	
			'class' => 'list-group-item ',
        	'target'=> '_blank',
			'title'=> Yii::t('app', 'Event Takings'),
			]) ?>
	</div>
  </div>
  <div class="col-md-6">
	<div class="list-group">
	    <?= Html::a('<i class="fa fa-money"> Payments</i>', ['#'],
			[	
			'class' => 'list-group-item active',
			]) ?>

  		<?= Html::a('<i class="fa fa-home"> All Payments</i>', ['/payment/list-report'],
			[	
			'class' => 'list-group-item ',
        	'target'=> '_blank',
			'title'=> Yii::t('app', 'All Payments'),
			]) ?>

	</div>
  </div>
</div>

</div>