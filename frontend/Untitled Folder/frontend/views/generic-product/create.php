<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GenericProduct */

$this->title = 'Create Generic Product';
$this->params['breadcrumbs'][] = ['label' => 'Generic Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="generic-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
