<?php
use yii\helpers\Url;

$this->title = 'Availability Calendar';
?>
<div class="row">
  <div class="col-md-9 col-sm-12">
    <div class="card-box">
       <div class="card-head">
          <header>Calendar</header>
       </div>
       <div class="card-body ">
        <div class="panel-body"> 
          <div id="calendar" class="has-toolbar"> </div>                             
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
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-12">
     <div class="card-box">
         <div class="card-head">
             <header>Draggable Bookings</header>
         </div>
         <div class="card-body ">
          <div id="external-events">
                <form class="inline-form">
                    <input type="text" value="" class="form-control" placeholder="Event Title..." id="event_title" />
                    <br/>
                    <a href="javascript:;" id="event_add" class="btn deepPink-bgcolor"> Add Event </a>
                </form>
                <hr/>
                <div id="event_box" class="mg-bottom-10"></div>
                <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline" for="drop-remove"> remove after drop
                    <input type="checkbox" class="group-checkable" id="drop-remove" />
                    <span></span>
                </label>
                <hr class="visible-xs" /> 
            </div>
         </div>
     </div>
 </div>
</div>

