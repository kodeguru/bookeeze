<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="contact-list">

  <p>
    <?= Html::a('Create Contact', ['contact/create', 'organization_id' => $organization_id], ['class' => 'btn btn-success']) ?>
  </p>

<?php
  echo ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => '_card',
      'layout' => '{items}',
  ]);
?>

</div>
