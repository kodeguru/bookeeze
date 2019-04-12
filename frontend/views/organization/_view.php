<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Organizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$contacts = Yii::$app->controller->renderPartial('@app/views/contact/_view',[
  'model' => $model->getContacts()->one(),
]);

$service_offer = Yii::$app->controller->renderPartial('@app/views/organization-service-offer/_list',[
  'service_offers' => $model->organizationServiceOffersList,
]);

?>
<div class="organization-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div>
            <h3 style="padding-left:25px;"><?= $model->name; ?></h3>
          </div>
          <div class="col-md-8">
            <div class="panel panel-default" id="thumbnail-panel">
              <div class="panel-body">
                <p class="thumbnail">
                  <img src="<?= $model['picture'] ?>" alt="<i class='fa fa-ticket'> Bookeezz!</i>" class="img-thumbnail" style="height: 200px; width: auto; display: block;">
                </p>
              </div>
            </div>
            <div class="panel panel-default" id="description-panel">
              <div class="panel-body">
                <?= Yii::$app->formatter->asHtml($model->description) ?>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default" id="contacts">
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
