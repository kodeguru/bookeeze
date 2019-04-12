<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Organizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Branches', ['create', ['id' => $model->id, 'parent_id' =>$model->id]], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php

        $contacts = Yii::$app->controller->renderPartial('@app/views/contact/list',[
            'organization_id' => $model->id,
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getContacts(),
                'pagination' => false
                ]),
        ]);
    ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <p class="thumbnail">
              <img src="<?= $model['picture'] ?>" alt="<i class='fa fa-ticket'> Bookeezz!</i>" class="img-thumbnail" style="height: 200px; width: auto; display: block;">
            </p>
          </div>
          <div class="col-md-4">
            <div class="branches">
              <?= Yii::$app->controller->renderPartial('_index',[
                          'dataProvider' => new \yii\data\ActiveDataProvider([
                              'query' => $model->getOrganizations(),
                              'pagination' => false
                              ]),
                          'order_id' => $model->id,
                      ]);
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <?= $contacts ?>
          </div>
        </div>
        <?= Yii::$app->formatter->asHtml($model->description) ?>
      </div>
    </div>

</div>



<div class="products" style="padding-top: 10px">

<h3><?= Html::encode("Products") ?></h3>


<?php
    $tours = Yii::$app->controller->renderPartial('@app/views/tour/_index',[
        'organization_id' => $model->id,
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getTours(),
            'pagination' => false
            ]),
    ]);

    $hotel_room = Yii::$app->controller->renderPartial('@app/views/hotel-room/list',[
        'organization_id' => $model->id,
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getHotelRooms(),
            'pagination' => false
            ]),
    ]);

    $car_rental = Yii::$app->controller->renderPartial('@app/views/rental-vehicle/_index',[
        'organization_id' => $model->id,
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getRentalVehicles(),
            'pagination' => false
            ]),
    ]);

    $restaurant_menu = Yii::$app->controller->renderPartial('@app/views/restaurant-menu/_index',[
        'organization_id' => $model->id,
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getRestaurantMenus(),
            'pagination' => false
            ]),
    ]);


    $generic_product = Yii::$app->controller->renderPartial('@app/views/generic-product/_index',[
        'organization_id' => $model->id,
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getGenericProducts(),
            'pagination' => false
            ]),
    ]);

    echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'items' => [
            [
                'label' => 'Hotel Rooms',
                'content' =>  isset($hotel_room) ? $hotel_room : null,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'hotel_rooms_tab'],
            ],
            [
                'label' => 'Tours',
                'content' =>  isset($tours) ? $tours : null,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'tours_tab'],
                // 'active' => $model->quote_status === $model::SENT_QUOTE ? true : false,
            ],
            [
                'label' => 'Car Rental',
                'content' =>  isset($car_rental) ? $car_rental : null,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'rentals_tab'],
                // 'active' => $model->quote_status === $model::SENT_QUOTE ? true : false,
            ],
            [
                'label' => 'Restaurant Menu',
                'content' =>  isset($restaurant_menu) ? $restaurant_menu : null,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'restaurant_tab'],
                // 'active' => isset($car_rental) ? true : falsee,
            ],
            [
                'label' => 'Generic Product',
                'content' =>  isset($generic_product) ? $generic_product : null,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'generic_product_tab'],
                // 'active' => isset($car_rental) ? true : falsee,
            ],
        ],
    ]);

?>

</div>
