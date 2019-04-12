<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use mdm\admin\components\MenuHelper;


AppAsset::register($this);
$mainAsset = Yii::$app->request->baseUrl.'/frontend/assets/';
$controller = Yii::$app->controller;
$default_controller = Yii::$app->defaultRoute;
$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
$mainAsset = Yii::$app->request->baseUrl.'/frontend/assets/';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="com_content view-category task- itemid-115 body__home">
<?php $this->beginBody() ?>

<div id="wrapper">
    <div id="header-wrapper" class="shifted">
     <?= $this->render(
        'header.php',
        [
        //'directoryAsset' => $directoryAsset,
        'mainAsset' => $mainAsset,
        'visible'=>!\Yii::$app->user->isGuest
        ]
    ) ?>
    
    <div style="display: none; width: 99.96%; height: 121px; float: none;">
    </div>
    <!-- slider -->
     <div id="slider-row">
                <div class="row-wrapper visible">
                    <div class="row-container ">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="moduletable   span12">
                                    <div class="moduletable-wrapper">
                                        <div id="sequence106" class="sequence-slider" style="padding-bottom:40%">
                                         <div class="sequence-prev"></div>
                                         <div class="sequence-next"></div>
                                         <div class="sequence-pause"></div>
                                         <ul class="sequence-canvas">
                                            <li class="firstItem num0 animate-in" style="z-index: 3; opacity: 1;">  
                                                <img class="slide-img" src="<?= $mainAsset ?>/images/slide-3.jpg" alt="" style="">
                                                <div class="info" style="">
                                                    <h1>Book Your Stay Today!</h1>
                                                    <h3>Find your ideal hotel and compare prices from different websites</h3> 
                                                </div>
                                            </li>
                                            <li class="num1 animate-out" style="opacity: 1; z-index: 1;">   
                                                <img class="slide-img" src="<?= $mainAsset ?>/images/slide-2.jpg" alt="" style="">

                                                <div class="info" style="">
                                                    <h1>Hotels Combined</h1>
                                                    <h3>The best choice for complete travel packages. The lowest prices for families or couples.</h3>
                                                </div>
                                            </li>
                                            <li class="lastItem num2 animate-out" style="opacity: 1; z-index: 1;">
                                                <img class="slide-img" src="<?= $mainAsset ?>/images/slide-1.jpg" alt="" style="">
                                                <div class="info" style="">
                                                     <h1>Excellent Rewards Programs </h1>
                                                    <h3>Offering prices, rewards points and other benefits giving you the best value in a hotel booking service, especially for frequent travelers.</h3>
                                                </div>
                                            </li>
                                         </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        <!-- /slider -->
</div><!--  /header-wrapper -->
<div id="bottom-header-row" class="shifted">
<div class="row-wrapper visible">
<div class="row-container ">
<div class="container-fluid">
<div class="row-fluid">

<div class="span12">
    <div id="main-search">
        <!-- <php//Yii::$app->controller->renderPartial('//product/index') ?> -->
    </div>
</div>
<!-- content -->
<div class="wrap content">
    <div class="container" style="padding-top: 8px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<!-- /content -->

<div class="intro_items">
        <div class="moduletable left-to-right  span6">
            <div class="moduletable-wrapper">
                <div class="mod-article-single mod-article-single__left-to-right" id="module_208">
                    <div class="item__module" id="item_119">
                        <!-- Item Title -->
                        <h3 class="item-title">
                            <a href="<?= $mainAsset ?>/images/save-your-time">Save Your Time</a>
                        </h3>
                        <!-- Intro Text -->
                        <div class="item_introtext">
                            <h4>Vestibulum dui felis, euismod id orci non.</h4>
                            <p>Quisque egestas nibh sed ligula bibendum interdum. In aliquet, nulla at mattis molestie, sapien diam pharetra nibh, non varius risus ante sedurna. Vestibulum dui felis, euismod id orci non, dignissim gravida purus.</p>
                            <a class="btn btn-info readmore" href="<?= $mainAsset ?>/images/save-your-time"><span>Read more</span></a>        
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    <div class="moduletable left-to-right-long  span6">
        <div class="moduletable-wrapper">
            <div class="mod-article-single mod-article-single__left-to-right-long" id="module_209">
                <div class="item__module" id="item_118">
                    <!-- Item Title -->
                    <h3 class="item-title">
                        <a href="<?= $mainAsset ?>/images/apartments-for-rent">Apartments For Rent</a>
                    </h3>
                    <!-- Intro Text -->
                    <div class="item_introtext">
                        <h4>Quisque egestas nibh sed ligula bibendum.</h4>
                        <p>In aliquet, nulla at mattis molestie, sapien diam pharetra nibh, non varius risus ante sed urna. Vestibulum dui felis, euismod id orci non, dignissim gravida purus. Quisque egestas nibh sed ligula bibendum interdum.</p>
                        <a class="btn btn-info readmore" href="<?= $mainAsset ?>/images/apartments-for-rent"><span>Read more</span></a>       
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>




<!-- gallery -->
<section class="page-gallery page-gallery__home">
    <!-- Filter -->
    <div class="clearfix"></div>
     <ul id="isotopeContainer" class="gallery items-row cols-3  hover_true grid">
        <li class="gallery-item mix mix_all gallery-grid gallerylatest firstItem" data-date="20141111192044" data-name="Suspendisse venenatis" data-popularity="220" style="display: inline-block;  opacity: 1;">
      
<div class="view">

    <!-- Image  -->
  <figure class="item_img img-intro img-intro__left">
        <a class="touchGalleryLink zoom galleryZoomIcon" href="<?= $mainAsset ?>/images/gallery/gallery-img9.jpg">   
      <span class="zoom-bg"></span>
      <span class="zoom-icon"></span>
      <img src="<?= $mainAsset ?>/images/gallery-img9.jpg" alt="">
          </a>
      </figure>    
  
    <div class="mask">
    <div class="mask_wrap">
      <div class="mask_cont">

          <!--  title/author -->
            <div class="item_header">
                <h3 class="item_title">                     <a href="<?= $mainAsset ?>/images/109-gallery-9"> <span class="item_title_part0">Suspendisse</span> <span class="item_title_part1">venenatis</span> </a>
                    </h3>           </div>
              
          <!-- info BOTTOM -->
                    
        <div class="item_more">
          <a href="<?= $mainAsset ?>/images/gallery/gallery-img9.jpg" class="galleryZoom"><i class="fa fa-search-plus"></i></a>
                    <a href="<?= $mainAsset ?>/images/109-gallery-9" class="hover_more btn btn-info">
            <i class="fa fa-sign-in"></i>
            <span>
              Read more            </span>
          </a>
                  </div>
                </div>
    </div>
  </div>
</div>
      <div class="clearfix"></div>
    </li>
        <li class="gallery-item mix mix_all gallery-grid gallerylatest" data-date="20141111192044" data-name="Ut mauris arcu" data-popularity="195" style="display: inline-block;  opacity: 1;">
      
<div class="view">

    <!-- Image  -->
  <figure class="item_img img-intro img-intro__left">
        <a class="touchGalleryLink zoom galleryZoomIcon" href="<?= $mainAsset ?>/images/gallery/gallery-img8.jpg">   
      <span class="zoom-bg"></span>
      <span class="zoom-icon"></span>
      <img src="<?= $mainAsset ?>/images/gallery-img8.jpg" alt="">
          </a>
      </figure>    
  
    <div class="mask">
    <div class="mask_wrap">
      <div class="mask_cont">

          <!--  title/author -->
            <div class="item_header">
                <h3 class="item_title">                     <a href="<?= $mainAsset ?>/images/111-gallery-8"> <span class="item_title_part0">Ut</span> <span class="item_title_part1">mauris</span> <span class="item_title_part2">arcu</span> </a>
                    </h3>           </div>
              
          <!-- info BOTTOM -->
                    
        <div class="item_more">
          <a href="<?= $mainAsset ?>/images/gallery/gallery-img8.jpg" class="galleryZoom"><i class="fa fa-search-plus"></i></a>
                    <a href="<?= $mainAsset ?>/images/111-gallery-8" class="hover_more btn btn-info">
            <i class="fa fa-sign-in"></i>
            <span>
              Read more            </span>
          </a>
                  </div>
                </div>
    </div>
  </div>
</div>
      <div class="clearfix"></div>
    </li>
        <li class="gallery-item mix mix_all gallery-grid gallerylatest" data-date="20141111192044" data-name="Donec scelerisque" data-popularity="129" style="display: inline-block;  opacity: 1;">
      
<div class="view">

    <!-- Image  -->
  <figure class="item_img img-intro img-intro__left">
        <a class="touchGalleryLink zoom galleryZoomIcon" href="<?= $mainAsset ?>/images/gallery/gallery-img5.jpg">   
      <span class="zoom-bg"></span>
      <span class="zoom-icon"></span>
      <img src="<?= $mainAsset ?>/images/gallery-img5.jpg" alt="">
          </a>
      </figure>    
  
    <div class="mask">
    <div class="mask_wrap">
      <div class="mask_cont">

          <!--  title/author -->
            <div class="item_header">
                <h3 class="item_title">                     <a href="<?= $mainAsset ?>/images/113-gallery-5"> <span class="item_title_part0">Donec</span> <span class="item_title_part1">scelerisque</span> </a>
                    </h3>           </div>
              
          <!-- info BOTTOM -->
                    
        <div class="item_more">
          <a href="<?= $mainAsset ?>/images/gallery/gallery-img5.jpg" class="galleryZoom"><i class="fa fa-search-plus"></i></a>
                    <a href="<?= $mainAsset ?>/images/113-gallery-5" class="hover_more btn btn-info">
            <i class="fa fa-sign-in"></i>
            <span>
              Read more            </span>
          </a>
                  </div>
                </div>
    </div>
  </div>
</div>
      <div class="clearfix"></div>
    </li>
        <li class="gallery-item mix mix_all gallery-grid gallerylatest" data-date="20141111192044" data-name="Etiam tristique" data-popularity="85" style="display: inline-block;  opacity: 1;">
      
<div class="view">

    <!-- Image  -->
  <figure class="item_img img-intro img-intro__left">
        <a class="touchGalleryLink zoom galleryZoomIcon" href="<?= $mainAsset ?>/images/gallery/gallery-img3.jpg">   
      <span class="zoom-bg"></span>
      <span class="zoom-icon"></span>
      <img src="<?= $mainAsset ?>/images/gallery-img3.jpg" alt="">
          </a>
      </figure>    
  
    <div class="mask">
    <div class="mask_wrap">
      <div class="mask_cont">

          <!--  title/author -->
            <div class="item_header">
                <h3 class="item_title">                     <a href="<?= $mainAsset ?>/images/110-gallery-3"> <span class="item_title_part0">Etiam</span> <span class="item_title_part1">tristique</span> </a>
                    </h3>           </div>
              
          <!-- info BOTTOM -->
                    
        <div class="item_more">
          <a href="<?= $mainAsset ?>/images/gallery/gallery-img3.jpg" class="galleryZoom"><i class="fa fa-search-plus"></i></a>
                    <a href="<?= $mainAsset ?>/images/110-gallery-3" class="hover_more btn btn-info">
            <i class="fa fa-sign-in"></i>
            <span>
              Read more            </span>
          </a>
                  </div>
                </div>
    </div>
  </div>
</div>
      <div class="clearfix"></div>
    </li>
        <li class="gallery-item mix mix_all gallery-grid gallerylatest" data-date="20141111192044" data-name=" Aenean elit risus" data-popularity="133" style="display: inline-block;  opacity: 1;">
      
<div class="view">

    <!-- Image  -->
  <figure class="item_img img-intro img-intro__left">
        <a class="touchGalleryLink zoom galleryZoomIcon" href="<?= $mainAsset ?>/images/gallery/gallery-img7.jpg">   
      <span class="zoom-bg"></span>
      <span class="zoom-icon"></span>
      <img src="<?= $mainAsset ?>/images/gallery-img7.jpg" alt="">
          </a>
      </figure>    
  
    <div class="mask">
    <div class="mask_wrap">
      <div class="mask_cont">

          <!--  title/author -->
            <div class="item_header">
                <h3 class="item_title">                     <a href="<?= $mainAsset ?>/images/112-gallery-7"> <span class="item_title_part0"></span> <span class="item_title_part1">Aenean</span> <span class="item_title_part2">elit</span> <span class="item_title_part3">risus</span> </a>
                    </h3>           </div>
              
          <!-- info BOTTOM -->
                    
        <div class="item_more">
          <a href="<?= $mainAsset ?>/images/gallery/gallery-img7.jpg" class="galleryZoom"><i class="fa fa-search-plus"></i></a>
                    <a href="<?= $mainAsset ?>/images/112-gallery-7" class="hover_more btn btn-info">
            <i class="fa fa-sign-in"></i>
            <span>
              Read more            </span>
          </a>
                  </div>
                </div>
    </div>
  </div>
</div>
      <div class="clearfix"></div>
    </li>
        <li class="gallery-item mix mix_all gallery-grid gallerylatest" data-date="20141111192044" data-name="Pellentesque auctor" data-popularity="113" style="display: inline-block;  opacity: 1;">
      
<div class="view">

    <!-- Image  -->
  <figure class="item_img img-intro img-intro__left">
        <a class="touchGalleryLink zoom galleryZoomIcon" href="<?= $mainAsset ?>/images/gallery/gallery-img6.jpg">   
      <span class="zoom-bg"></span>
      <span class="zoom-icon"></span>
      <img src="<?= $mainAsset ?>/images/gallery-img6.jpg" alt="">
          </a>
      </figure>    
  
    <div class="mask">
    <div class="mask_wrap">
      <div class="mask_cont">

          <!--  title/author -->
            <div class="item_header">
                <h3 class="item_title">                     <a href="<?= $mainAsset ?>/images/114-gallery-6"> <span class="item_title_part0">Pellentesque</span> <span class="item_title_part1">auctor</span> </a>
                    </h3>           </div>
              
          <!-- info BOTTOM -->
                    
        <div class="item_more">
          <a href="<?= $mainAsset ?>/images/gallery/gallery-img6.jpg" class="galleryZoom"><i class="fa fa-search-plus"></i></a>
                    <a href="<?= $mainAsset ?>/images/114-gallery-6" class="hover_more btn btn-info">
            <i class="fa fa-sign-in"></i>
            <span>
              Read more            </span>
          </a>
                  </div>
                </div>
    </div>
  </div>
</div>
      <div class="clearfix"></div>
    </li>
        <li class="gap"></li>
    <li class="gap"></li>
    <li class="gap lastItem"></li>
  </ul>
  </section>
<!-- /gallery -->

</div>
</div>
</div>
</div>
</div>

                
        <!-- END OF HEADER ROWS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        
        <!-- CONTENT ROWS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->



<footer class="footer">
    <div class="section-footer-bottom">
        <div class="container-fluid">
          <div class="row-fluid">
            <div class="col-xs-12 col-sm-6 pull-left">
              <p class="privacy">Bookeaze © <span id="copyright-year"><?= date('Y') ?></span> <span>• </span> <a href="privacy-policy.html">Privacy Policy</a>
              </p>
            </div>
            <div class="col-xs-12 col-sm-6 pull-right" style="text-align: right;">
                <p class="pull-right"><a href="http://www.skymouse-itconsult.com">SKYMOUSE IT-CONSULT</a></p>
              <div class="soc-block"><a class="fa fa-circle fa-circle-md fa-circle-white fa-twitter" href="#"></a>
                <a class="fa fa-circle fa-circle-md fa-circle-white fa-facebook-square" href="#"></a><a class="fa fa-circle fa-circle-md fa-circle-white fa-instagram" href="#"></a><a class="fa fa-circle fa-circle-md fa-circle-white fa-pinterest" href="#"></a><a class="fa fa-circle fa-circle-md fa-circle-white fa-youtube-play" href="#"> </a></div>
            </div>
          </div>
        </div>
      </div>
</footer>
</div><!-- wrapper -->



<?php
     yii\bootstrap\Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'header' => '<h2>title</h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
        //keeps from closing modal with esc key or by clicking out of the modal.
        // user must click cancel or X to close
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'></div>";
    yii\bootstrap\Modal::end();

?>

<?php $this->endBody() ?>
</body>
</html>

<script>
    jQuery(document).ready(function($){
        var options106 = {
            autoPlay: true,
            autoPlayDelay: 7000,
            // startingFrameID: ,
            nextButton:true,
            prevButton:true,
            pauseButton:true,
                        pagination: false,
                        preloader: false,
            pauseOnHover:true,
            reverseAnimationsWhenNavigatingBackwards:false,
            fallback: {
                theme: "fade",
                speed: 2000
            },
            swipeEvents: {
                left: "next",
                right: "prev",
                up: false,
                down: false
            }
        }
        var sequence = $("#sequence106").sequence(options106).data("sequence");
    });
    // initialise plugins
    $(function($){
        $('#module-99')
             
        .superfish({
            hoverClass:    'sfHover',         
            pathClass:     'overideThisToUse',
            pathLevels:    1,    
            delay:         500, 
            animation:     {opacity:'show'}, 
            speed:         'normal',   
            speedOut:      'fast',   
            autoArrows:    false, 
            disableHI:     false, 
            useClick:      0,
            easing:        "swing",
            onInit:        function(){},
            onBeforeShow:  function(){},
            onShow:        function(){},
            onHide:        function(){},
            onIdle:        function(){}
        })
         
        var ismobile = navigator.userAgent.match(/(iPhone)|(iPod)|(android)|(webOS)/i)
        if(ismobile){
            $('#module-99').sftouchscreen();
        }
        $('.btn-sf-menu').click(function(){
            $('#module-99').toggleClass('in')
        });
        $('#module-99').parents('[id*="-row"]').scrollToFixed({minWidth :751});
    });

$(window).on('load',  function() {
                new JCaption('img.caption');
            });
$(function($) {
             $('.hasTip').each(function() {
                var title = $(this).attr('title');
                if (title) {
                    var parts = title.split('::', 2);
                    var mtelement = document.id(this);
                    mtelement.store('tip:title', parts[0]);
                    mtelement.store('tip:text', parts[1]);
                }
            });
            var JTooltips = new Tips($('.hasTip').get(), {"maxTitleChars": 50,"fixed": false});
});
    
</script>

<?php 
$this->registerJs("

$(function($){
    var value = '". Yii::$app->request->baseUrl.'/product/index' ."';
    $('#wrapper').find('#main-search')
                    .load(value + ' #main-search');
    
});
");

$this->endPage();
?>
 
