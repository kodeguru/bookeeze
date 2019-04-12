<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$formatter = \Yii::$app->formatter;
?>
<h4>Contacts</h4>
<div class="contact-view">

  <address>
    <abbr title="Telephone">Telephone: </abbr><?= isset($model->telephone) ? $formatter->asText($model->telephone) : ''; ?><br>
    <abbr title="Mobile">Mobile: </abbr><?= isset($model->mobilephone) ? $formatter->asText($model->mobilephone) : ''; ?><br>
    <abbr title="Website">Website: </abbr><?= isset($model->website) ? $formatter->asUrl($model->website) : ''; ?><br>
    <abbr title="Email">Email: </abbr><?= isset($model->email_address) ? $formatter->asEmail($model->email_address) : ''; ?><br>
    <abbr title="Postal">Postal: </abbr><?= isset($model->postal_address) ? $formatter->asText($model->postal_address) : ''; ?><br>
    <abbr title="Physical">Physical: </abbr><?= isset($model->physical_address) ? $formatter->asText($model->physical_address) : ''; ?><br>
    <abbr title="Map">Map: </abbr><?= isset($model->map_address) ? $formatter->asText($model->map_address) : ''; ?><br>
  </address>

</div>
