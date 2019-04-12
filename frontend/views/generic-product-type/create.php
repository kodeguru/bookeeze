<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GenericProductType */

$this->title = 'Create Generic Product Type';
$this->params['breadcrumbs'][] = ['label' => 'Generic Product Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="generic-product-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
