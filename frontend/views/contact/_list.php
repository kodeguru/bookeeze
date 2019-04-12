<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="contact-list">

<h3>Contacts</h3>  

<?php
  echo ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => '_card',
      'layout' => '{items}',
  ]);
?>

</div>
