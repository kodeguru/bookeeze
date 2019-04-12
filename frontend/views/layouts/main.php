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
<body>
<?php $this->beginBody() ?>

<div id="wrapper">
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
<div id="bottom-header-row" class="shifted">

<?php if ($isHome) { ?>
<section id="intro">
	<div class="intro-container">
	  <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">
	  	<div class="wrap content container">
	        <div id="main-search" class="col-sm-12">
	        </div>
        </div>
	  </div>
	</div>
</section>
<?php } ?>

<div class="row-wrapper visible">


<!-- content -->
<div id="content" class="wrap content">
	<!-- <div class="page-bar">
               <= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
           
    </div> -->
	 <div class="container"></div>
    <div class="container1">

        <div class="row">
            <section id="search-results" class="content-box col-sm-12"></section>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<!-- /content -->

<div id="hotels" class="container"></div>

<?php 
if ($isHome) {
   echo $this->render('@frontend/views/site/_gallery');
}

?>


</div>
</div>
</div>
</div>
</div>

                
        <!-- END OF HEADER ROWS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        
        <!-- CONTENT ROWS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->






<!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>Bookeaze</h3>
            <p>Book accomodation wherever whenever. 
Justo eget nada terra videa magna derita valies darta donna mare 
fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet 
proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-home"></i> <a href="#">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              P.O Box AE 177 AEH <br>
              Gaborone<br>
              Botswana <br>
              <strong>Phone:</strong> (+267) 391-5458 <br>
              <strong>Email:</strong> info@bookeazz.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Join our newsletter today to receive news and latest update on our products and services.</p>
            <form action="" method="post">
              <input name="email" type="email"><input value="Subscribe" type="submit">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
       Bookeaze © <span id="copyright-year"><?= date('Y') ?></span> <span>• </span> <a href="privacy-policy">Privacy Policy</a>
      </div>
      <div class="credits">
        Designed by <a href="https://skymouse-itconsult.com/">Skymouse IT-Consult</a>
      </div>
    </div>
  </footer><!-- #footer -->
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


<?php 
$isHome = isset($isHome)  ? $isHome : false; 
$this->registerJs("

$(function($){
    $('.product-index').remove();
    var value = '". Yii::$app->request->baseUrl.'/product/index' ."';
    var hotels = '". Yii::$app->request->baseUrl.'/organization/listing' ."';
    var isHome = '". $isHome ."';
    if (isHome) {
    	$('#main-search').load(value );
    	//$('#hotels').load(hotels );
	} else {
		$('#main-search-top').load(value );
	}
   
});
");

$this->endPage();
?>
 
