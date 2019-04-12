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
<body class="" data-spy="scroll" data-target=".navbar" data-offset="50">
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

</div><!--  /header-wrapper -->
<div id="bottom-header-row" class="shifted">
<div class="row-wrapper visible">


<!-- content -->
<div class="wrap content">
    <div class="container" style="padding-top: 8px;">
        <div class="row">

            <div class="wrap content">
                <div class="container" style="padding-top: 8px;">
                    <div class="rowf">
                        <div id="main-search" class="col-sm-12">
                        </div>
                    </div>
                </div>
            </div>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<!-- /content -->


<section id="intro_items">
<div class="intro_items container">
    <div class="row-fluid">
        <div class="moduletable left-to-right span6">
            <div class="moduletable-wrapper">
                <div class="mod-article-single mod-article-single__left-to-right" >
                    <div class="item__module" >
                        <!-- Item Title -->
                        <h3 class="item-title">
                            <a href="<?= $mainAsset ?>/images/save-your-time">The Best Hotel Deals</a>
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
            <div class="mod-article-single mod-article-single__left-to-right-long" >
                <div class="item__module" >
                    <!-- Item Title -->
                    <h3 class="item-title">
                        <a href="<?= $mainAsset ?>/images/apartments-for-rent">Book Your Stay</a>
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
</div>
</section>

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



<footer class="footer">
    <div class="section-footer-bottom">
        <div class="container-fluid">
          <div class="row-fluid">
            <div class="col-xs-12 col-sm-6 pull-left">
              <p class="privacy">Bookeaze © <span id="copyright-year"><?= date('Y') ?></span> <span>• </span> <a href="privacy-policy.html">Privacy Policy</a>
              </p>
            </div>
            <div class="col-xs-12 col-sm-6 pull-right" style="text-align: right;">
               <!--  <p class="pull-right">
                    <a href="http://www.skymouse-itconsult.com">SKYMOUSE IT-CONSULT</a>
                </p> -->
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


<?php 
$this->registerJs("

$(function($){
    $('.product-index').remove();
    var value = '". Yii::$app->request->baseUrl.'/product/index' ."';
    $('#main-search').load(value );
    
});
");

$this->endPage();
?>
 
