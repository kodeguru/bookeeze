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
?>
<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: HEADER -->


<div class="top" id="top-header">
   
        <div class="mod-custom mod-custom__address pull-right">
            <p>
                <span><i class="fa fa-map-marker"></i>Tlhwane Road, Plot 6406. Broadhurst</span>
                <span><i class="fa fa-phone"></i> (+267) 391-5458</span>
            </p>
        </div>
   
</div>

<div id="top-header-row">
    <div class="row-wrapper visible">
        <div class="row-container ">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div id="logo" class="span4">
                        <a href="<?= Url::home(true) ?>">
                            <img src="<?= $mainAsset ?>/images/logo.png" alt="Perfect Rent">
                        </a>
                    </div>
                    <div class="span8">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<?php                   //absoluteHomeUrl
                        //$home = Url::home(true);
                        $items[] = ['label' => 'Home', 'url' => ['/site/index']];
                        $items[] = ['label' => 'Hotels', 'url' => ['/product/index'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
                        
                        //$items[] = ['label' => 'About', 'url' => ['/site/about']];
                        $items[] = ['label' => 'About', 'url' => ['/site/index#about'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
                        $items[] = ['label' => 'Contact', 'url' => ['/site/contact'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
                        // $items[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
                        // $items[] = ['label' => 'Login', 'url' => ['/site/login'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
                        $items[] = ['label' => 'Cart', 'url' => ['/order/cart'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];

                        if (Yii::$app->user->isGuest) {
                            $useritems[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
                            $useritems[] = ['label' => 'Login', 'url' => ['/site/login'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>'']];
                            //$items[] = ['label' => 'BOOK NOW', 'url' => ['/event/index'], 'options'=>['class'=>'small-btns'],'linkOptions'=>['class'=>''], 'linkTemplate' => '<a href="{url}"><i class="fa fa-ticket"></i>{label}</a>' ];
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
                                                'options'=>['class'=>'page-scroll']
                                            ];
                            };

                            $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
                            $items[] = [
                                                'label'=>'Logout',
                                                'url'=>['/site/logout'],
                                                'linkOptions'=>['data-method'=>'post','class'=>'c-link dropdown-toggle'],
                                                'options'=>['class'=>'page-scroll']
                                            ];
                            $username = Yii::$app->user->identity->username;
                            $useritems[] = ['label' => $username, 'url' => ['#'], 'options'=>['class'=>' small-btns dropdown'],'linkOptions'=>['class'=>'dropdown-toggle','data-toggle'=>'dropdown'],'linkTemplate' => '<a href="{url}"><<img alt="Avatar" src="assets/img/avatar2.jpg"/><span>{label}</span><b class="fa fa-user"></b></a>',
                                'items' => [
                                    // ['label' => 'My Account', 'url' => ['site/account'], 'options'=>['class'=>'']],
                                    // ['label' => 'Profile', 'url' => ['site/profile'], 'options'=>['class'=>'']],
                                    // ['label' => 'Messages', 'url' => ['site/messages'], 'options'=>['class'=>'']],
                                    ['label' => 'Sign Out', 'url' => ['site/logout'], 'options'=>['class'=>''], 'linkOptions'=>['data-method'=>'post']],
                                    // ['label' => 'Profile', 'url' => [$view,'id' => $cust_id], 'options'=>['class'=>''], 'linkOptions'=>['data-method'=>'post']]
                                  ],

                            ];
                        }
                // echo '<div clas="row"><div class="col-md-9">';
               
                // echo '</div></div>';
                 // <ul class="nav navbar-nav navbar-right user-nav">

    

    ?>
<div id="menu-row" style="z-index: 1000; position: static; top: auto;" class=""> 
    <div class="row-wrapper visible">
        <div class="row-container ">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="moduletable navigation main_menu  span12">
                        <div class="moduletable-wrapper">
                            <a class="btn btn-navbar btn-sf-menu">
                                <span class="fa fa-bars"></span>
                            </a>
                            <ul class="sf-menu sticky" id="module-99">
                               
                            </ul>
                            <?php 
                                 echo Nav::widget([
                                    'options' => ['class' => 'sf-menu sticky sf-js-enabled'],
                                    'items' => $items,
                                    //'linkOptions'=>['class'=>'c-link dropdown-toggle'],
                                ]);
                                // echo '</div> <div class="col-md-3">';
                                echo Nav::widget([
                                    'options' => ['class' => 'sf-menu sticky user-nav sf-menu'],
                                    'items' => $useritems,
                                    //'linkOptions'=>['class'=>'c-link dropdown-toggle'],
                                ]);
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>










