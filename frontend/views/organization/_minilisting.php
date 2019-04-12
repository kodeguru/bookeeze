<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use kartik\widgets\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Organization */

$this->title = $model->name;

$contacts = Yii::$app->controller->renderPartial('@app/views/contact/_view',[
  'model' => $model->getContacts()->one(),
]);

$service_offer = Yii::$app->controller->renderPartial('@app/views/organization-service-offer/_list',[
  'service_offers' => $model->organizationServiceOffersList,
]);

$hotel_room = Yii::$app->controller->renderPartial('@app/views/hotel-room/_mini_listroom',[
    'organization_id' => $model->id,
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getHotelRooms(),
        'pagination' => false
        ]),
]);

?>
<div class="organization-view" id="organization-view">
    <?php if (\Yii::$app->user->can('hotel_admin')) : ?>
      <div class="btn-toolbar" role="toolbar" >
        <div class="btn-group">
          <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'title'=>"Update"]) ?>
          <?= Html::a('<i class="fa fa-print"></i>', ['report', 'id' => $model->id], ['class' => 'btn btn-default', 'title'=>"Print"]) ?>
        </div>
      </div><br>
    <?php endif; ?>

    <!-- <div class="panel panel-default"> -->
    <div class="card-box">
      <div class="card-head">
        <header><?= $model->name; ?></header>
      </div>
      <div class="card-body ">
        <div class="row">
          <div class="col-md-4">
            <img src="<?= $model['picture'] ?>" alt="<i class='fa fa-ticket'> Bookeezz!</i>" class="img-thumbnail thumbnail" style="height: 200px; width: auto; display: block;">
          </div>
          <div class="col-md-4">
            <div>
            <?php
              echo '<span class="control-label">Rating</span>';

              echo \yii2mod\rating\StarRating::widget([
                  'name' => 'input_name',
                  'value' => $model->rating,
                  'clientOptions' => [
                     // Your client options
                    'readOnly' => 'readOnly'
                  ],
               ]);
            ?>
            </div>
            <p><?= $service_offer ?></p>
            <h4>Rooms</h4>
            <?= $hotel_room ?>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default" id="contacts">
              <?php if (\Yii::$app->user->can('hotel_admin')) : ?>
                <div class="panel-heading">
                    <div class="btn-group">
                      <?= Html::a('<i class="fa fa-pencil"></i>', ['contact/index', 'ContactSearch[organization_id]' => $model->id], ['class' => 'btn btn-primary', 'title'=>"Update"]) ?>
                    </div>
                </div>
              <?php endif; ?>
              <div class="panel-body">
                <p><?= $contacts ?></p>
                <p><?= $service_offer ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
