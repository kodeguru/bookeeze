<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotels';
?>
<?php
  if(Yii::$app->session->hasFlash('emptyCart'))
  echo  Alert::widget([
     'options' => ['class' => 'alert-info'],
     'body' => '<h3>' . Yii::$app->session->getFlash('emptyCart') . '</h3>',
  ]);
?>

<div class="product-index">

    <?php echo $this->render('_room-search', ['model' => $searchModel]); ?>

</div>
