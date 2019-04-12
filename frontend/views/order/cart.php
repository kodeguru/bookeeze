<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Shopping Cart';
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => ['cart']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Continue Shopping', ['/product/index'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Checkout',
                    ['invoice/checkout', 'order_id' => $model->id],
                    [
                      'class' => 'btn btn-danger',
                      'data' => [
                                'confirm' => 'Are you sure you want to checkout?',
                            ],
                    ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
              'attribute' => 'id',
              // 'visible' => ($model->customer_id !== 1) ? true : false,
            ],
            [
              'attribute' => 'customer_id',
              'visible' => ($model->customer_id !== 1) ? true : false,
            ],
            [
              'attribute' => 'created_at',
              'format' => 'date',
            ],
            [
              'attribute' => 'order_total',
              'value' => $model->getOrderTotal(),
            ],
            [
              'attribute' => 'order_status_id',
              'value' => $model->orderStatus->order_status,
            ],
            [
              'attribute' => 'pos_id',
              'visible' => ($model->customer_id !== 1) ? true : false,
            ],
        ],
    ]) ?>

    <div class=".col-xs-12 .col-md-4">
        <?= Yii::$app->controller->renderPartial('@app/views/order-item/_index',[
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getOrderItems(),
                    'pagination' => false
                    ]),
            ]);
        ?>
    </div>

</div>
