<?php
use yii\helpers\Url;

$this->title = 'Availability Calendar';
?>

<div class="Availability-calendar" style="padding:50px;padding-top:0;">
<?= yii2fullcalendar\yii2fullcalendar::widget([
      'options' => [
        'lang' => 'en',
        'height' => 650,
        'dayView' => true,
        'selectHelper' => true,
        //... more options to be defined here!
        // 'events'=> $events,
      ],
      'ajaxEvents' => Url::to(['jsoncalendar'])
    ]);
?>
</div>
