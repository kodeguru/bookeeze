<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use kartik\widgets\StarRating;
use app\models\Organization;

/* @var $this yii\web\View */
/* @var $model app\models\HotelRoom */

/* @var $this yii\web\View */
/* @var $model app\models\Organization */





$organization = Organization::findOne($model['id']);
$contacts = Yii::$app->controller->renderPartial('@app/views/contact/_view',[
  'model' => $organization->getContacts()->one(),
]);

$service_offer = Yii::$app->controller->renderPartial('@app/views/organization-service-offer/_list',[
  'service_offers' => $organization->organizationServiceOffersList,
]);

// $hotel_room = Yii::$app->controller->renderPartial('@app/views/hotel-room/_mini_listroom',[
//     'organization_id' => $organization->id,
//     'dataProvider' => new \yii\data\ActiveDataProvider([
//         'query' => $organization->getHotelRooms(),
//         'pagination' => false
//         ]),
// ]);

?>

<div class="organization-view" id="organization-view">
    <?php if (\Yii::$app->user->can('hotel_admin')) : ?>
      <div class="btn-toolbar" role="toolbar" >
        <div class="btn-group">
          <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $organization->id], ['class' => 'btn btn-primary', 'title'=>"Update"]) ?>
          <?= Html::a('<i class="fa fa-print"></i>', ['report', 'id' => $organization->id], ['class' => 'btn btn-default', 'title'=>"Print"]) ?>
        </div>
      </div><br>
    <?php endif; ?>

    <!-- <div class="panel panel-default"> -->
    <div class="card-box">
      <div class="card-head">
        <header><?= $organization->name; ?></header>
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
                  'value' => $organization->rating,
                  'clientOptions' => [
                     // Your client options
                    'readOnly' => 'readOnly'
                  ],
               ]);
            ?>
            </div>
            <p><?= $service_offer ?></p>


            <h4>Available Rooms</h4>
             <?php 
              foreach ($model['rooms'] as $key => $room) { ?>
                <div class="hotel-room-view">
                      <!-- Default panel contents -->
                      <span class="label label-sm label-success">
                         <?= Html::a($room['type'], ['hotel-room/view', 'id' => $room['id']], ['class' => '', 'title'=>$room['type']]) ?>
                      </span>

                      <span style="display: inline; font-size: 8px" class="">
                        - <strong>BWP: <?= $room['cost']; ?></strong>
                    
                        - <?= $room['qty']. " Available"; ?>
                      </span>
                </div>
             <?php } ?>
             <!-- end foreach -->


          </div>
          <div class="col-md-4">
            <div class="panel panel-default" id="contacts">
              <?php if (\Yii::$app->user->can('hotel_admin')) : ?>
                <div class="panel-heading">
                    <div class="btn-group">
                      <?= Html::a('<i class="fa fa-pencil"></i>', ['contact/index', 'ContactSearch[organization_id]' => $organization->id], ['class' => 'btn btn-primary', 'title'=>"Update"]) ?>
                    </div>
                </div>
              <?php endif; ?>
              <div class="panel-body">
                <p><?= $contacts ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
