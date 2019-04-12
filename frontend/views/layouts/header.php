<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\AdminLteAsset;
use app\models\Customer;
use frontend\widgets\Alert;
use mdm\admin\components\MenuHelper;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
$mainAsset = Yii::$app->request->baseUrl.'/frontend/assets/';
$controller = Yii::$app->controller;
$default_controller = Yii::$app->defaultRoute;

if (!(($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction))):
?>
<style type="text/css">
	.navbar {
	  margin-top: none;
	}

	.nav-menu {
	  background: none !important;
	}
	#header{
	  background: #869818;
	  height: 48px;
	  padding-bottom: 100px;
	  transition: all 0.5s;/
	}
	#header #top-header {
	  display: none;
	}

	#header #logo, #header.header-scrolled #logo {
	    background: #c9d875;
	    padding-bottom: 0px;
	    margin-top: 2px;
	}
	#header #logo {
	  float: left;
	  /*margin-top: 10px;*/
	  margin-left: 60px;
	  /*padding: 10px;*/
	  opacity: 1;
	  background: transparent;
	  background: #c9d875;
	  padding: none;
	}
	#header #logo img {
		/*background: #f6f8f0;*/
		padding-bottom: 0px;
		padding: 2px;
	    /*max-width: 115px;*/
	    height: auto;
	}
	#header.header-scrolled #main-search-top {
		margin-top:50px;
	}
	#main-search-top form {
	    background: #bdcf55;
	    padding: 10px;
	    padding-left: 100px;
	}
	#content {
		margin-top: 150px;
		padding-top: 5px;
	}
	.product-index .panel:first-child {
	    background-color: transparent;
	    border-radius: 0px;
	    border: none;
	    padding: 0px;
	    margin: 0px;
	}
	.product-index .panel-body:first-child {
	    padding: 2px;
	}
	.navbar {
	    min-height: 48px;
	    margin-bottom: 0px;
	}
</style>
<?php endif; ?>






<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: HEADER -->

<header id="header">
	<div class="top" id="top-header">
		<div class="mod-custom mod-custom__address pull-right">
		    <p>
		        <span><i class="fa fa-phone"></i>Tel:  (+267) 391-5458 </span>
		        <span><i class="fa fa-mail"></i>info@bookeazz.com</span>
	        	<span>
	        		<a href="https://www.facebook.com/pages/bookeazz"><li class="fa fa-facebook-square fa-inverse fa-2x"></li></a>
					<a href="https://www.twitter.com/bookeazz"><li class="fa fa-twitter-square fa-inverse fa-2x"></li></a>
					<a href="contact"><li class="fa fa-envelope fa-inverse fa-2x"></li> </a>
				</span>

		    </p>
		</div>
	</div>

<div class="container-fluid">
    <div class="col-sm-2">
        <div class="row-fluid">
            <div id="logo">
                <a href="<?= Url::home(true) ?>">
                    <img src="<?= $mainAsset ?>/images/logo.png" alt="Perfect Rent">
                </a>
            </div>
        </div>
    </div>

<div class="col-sm-10">


<?php

    //absoluteHomeUrl
    $home = Url::home(true);
    $items[] = ['label' => 'Home', 'url' => ['/site/index']];
    $items[] = ['label' => 'Hotels', 'url' => ['/organization/listing'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
    $items[] = ['label' => 'About', 'url' => ['/site/index#about'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
    $items[] = ['label' => 'Contact', 'url' => ['/site/contact'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
    $items[] = ['label' => 'Cart', 'url' => ['/order/cart'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];

    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
        $items[] = ['label' => 'Login', 'url' => ['/site/login'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
    } else {
        $callback = function ($menu) {
        return [
                    'label' => $menu['name'],
                    'url' => [$menu['route']],
                    'icon' => $menu['data'],
                    //'active' => $menu['route'],
                    'items' => $menu['children'],
                    'linkOptions'=>[
                        // 'data-method'=>'post',
                        'class'=>'c-link dropdown-toggle'
                    ],
                    'options'=>['class'=>'']
                ];
    };

        $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
        $items[] = [
                            'label'=>'Logout',
                            'url'=>['/site/logout'],
                            'linkOptions'=>['data-method'=>'post','class'=>''],
                            'options'=>['class'=>'']
                        ];
        $username = Yii::$app->user->identity->username;
        $items[] = ['label' => $username, 'url' => ['#'], 'options'=>['class'=>''],'linkOptions'=>['class'=>''],'linkTemplate' => '<a href="{url}"><img alt="Avatar" src="assets/img/avatar2.jpg"/><span>{label}</span><b class="fa fa-user"></b></a>',
            'items' => [
                // ['label' => 'My Account', 'url' => ['site/account'], 'options'=>['class'=>'']],
                // ['label' => 'Profile', 'url' => ['site/profile'], 'options'=>['class'=>'']],
                // ['label' => 'Messages', 'url' => ['site/messages'], 'options'=>['class'=>'']],
                ['label' => 'Sign Out', 'url' => ['site/logout'], 'options'=>['class'=>''], 'linkOptions'=>['data-method'=>'post']],
                // ['label' => 'Profile', 'url' => [$view,'id' => $cust_id], 'options'=>['class'=>''], 'linkOptions'=>['data-method'=>'post']]
              ],

        ];
    }




NavBar::begin([
        'options' => [
            'class' => 'nav-menu-container',
            'data-spy' => 'affix',
            'data-offset-top' => '197',
        ],
    ]);

echo Nav::widget([
        'options' => ['class' => 'nav-menu nav-right pull-right'],
        'items' => $items,
    ]);

NavBar::end();

                           ?>
<!-- <div class="container-fluid"> -->
     <!-- <div class="row-fluid"> -->
	<div id="main-search-top" class="col-sm-12">
	</div>
	</div> 
</header><!-- #header -->
