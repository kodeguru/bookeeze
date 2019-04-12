<?php

/* @var $this yii\web\View */

$this->title = 'Bookeaze';
?>


<div class="site-index">
<section id="about">
    <div id="main-content-top-row" class="row-fluid">
        <div id="content-top">
            <div class="moduletable text-center  span12">
                <div class="moduletable-wrapper">
                    <header>
                        <h2 class="moduleTitle "><span class="item_title_part0"></span> <span class="item_title_part1">About</span> <span class="item_title_part2">Us</span> </h2>
                    </header>
                        <div class="mod-custom mod-custom__text-center">
                            <p>Maecenas bibendum justo et augue vulputate, eget egestas ligula 
                            aliquet. Nullam nibh lectus, bibendum sodales est et, varius interdum 
                            massa. Ut molestie mollis posuere. Ut vulputate et lectus a dignissim. 
                            Vivamus tempus mollis risus. Maecenas vel dolor lacinia, feugiat enim 
                            eget, mattis ligula. Interdum et malesuada fames ac ante ipsum primis in
                            faucibus. Nunc faucibus at dolor quis tristique. Aenean laoreet 
                            vestibulum tellus, non tincidunt est. In vestibulum pellentesque sapien.
                            Curabitur dignissim eros arcu, et sollicitudin risus ultricies et. 
                            Nulla lobortis, turpis eget dignissim vestibulum, odio risus.</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
</div>




<?php 
$this->registerJs("

$(function($){
    var value = '". Yii::$app->request->baseUrl.'/product/index' ."';
    $('#main-search').load(value );
    
});
");
?>