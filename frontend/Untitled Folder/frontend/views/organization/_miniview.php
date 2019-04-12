<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Organization */
?>

<div class="organization-view col-xs-12 col-sm-12 col-md-4 col-lg-4">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading"><strong><?= $model['name']; ?></strong></div>
      <div class="panel-body">
        <p class="thumbnail">
          <img src="<?= $model['picture'] ?>" alt="<i class='fa fa-ticket'> Bookeezz!</i>" class="img-thumbnail" style="height: 200px; width: auto; display: block;">
        </p>
      </div>

      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item"><?= $model['description']; ?></li>
      </ul>
      <p class="text-center">
        <?= Html::a('View', ['organization/view', 'id' => $model['id']], ['class' => 'btn btn-success']) ?>
      </p>
    </div>

</div>
