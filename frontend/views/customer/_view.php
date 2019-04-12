<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <address>
              <abbr title="Customer">Customer Name : </abbr><strong><?= $model->fullname ?></strong><br>
              <abbr title="Phone">Phone : </abbr><?= isset($model->phone) ? $model->phone : null; ?><br>
              <abbr title="Mobile">Mobile : </abbr><?= isset($model->mobile) ? $model->mobile : null; ?><br>
              <abbr title="E-mail">E-mail : </abbr><?= isset($model->email) ? $model->email : null; ?><br>
            </address>
          </div>
          <div class="col-md-6">
            <address>
              <abbr title="Postal">Postal : </abbr><?= isset($model->address) ? $model->address : null;  ?><br>
              <abbr title="Physical">Physical : </abbr><?= isset($model->physical) ? $model->physical : null;  ?><br>
              <abbr title="Country">Country : </abbr><?= isset($model->country->country_name) ? $model->country->country_name : null; ?><br>
            </address>
          </div>
        </div>
      </div>
    </div>

</div>
