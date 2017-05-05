<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

AppAsset::register($this);
//$this->registerCssFile('css/libs/font-awesome.min.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ;
            $this->registerCss( ".panel-info{border: 0px}" );
            $this->registerCss( ".navbar-left li a {font-size:1.1em; color: #E7E7E7;padding: 30px 2px 0px 0px; background-color: #2A3F54; border: 0px solid white}" );
            $this->registerCss( "#firstLi a {font-size:1.1em; color: #E7E7E7;padding: 0px 2px 0px 0px; background-color: #2A3F54; border: 0px solid white}" );
            $this->registerCss( ".navbar-left li  ul li a {background-color: #2A3F54; border: 0px solid white}" );
            $this->registerCss( ".panel {background-color: #2A3F54; border: 0px solid white}" );
            $this->registerCss( ".first_title {background-color: ; border: 0px solid white; font-weight:400; font-size:15px} " );
           // $this->registerCss( "#profImg {width:500px}" );
            $this->registerCss( ".fa{font-size: 1.3em;}" );
            $this->registerCss( ".right_col{ position: relative; margin-top:0}" );
            //$this->registerJs("$('.panel-title').addClass('site_title')");
           // $this->registerCss( ".left_col{ position: relative; margin-top:5%}" );
    ?>
</head>
<body>
<?php $this->beginBody() ?>

 <?php    
 /** Declaration of $menuItems, the array of navBar items **/
 $menuItems = [
      //  ['label' => 'Home', 'url' => ['/site/index']],
       // ['label' => 'About', 'url' => ['/site/about']],
       // ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
 
 
/** Declaration of $menuItems2, the array of sideNav items **/

    if (Yii::$app->user->isGuest) {
        $menuItems2 = [];
      // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
      //  $menuItems[] = ['label' => 'Connexion','icon'=>'users', 'url' => ['/site/login']];
    } else {
    $menuItems2[] =  ['label'=>'<img src="uploads/img.jpg" id="ProfImg" class="img-circle profile_img" style="width:75px;" /><div class="center"> Bienvenu  ' . Yii::$app->user->identity->nom.'</div>', 'url'=>'#','options'=>['style'=>'padding:3px; margin: 0px ', 'id'=>'firstLi'] ];
        $menuItems2[] = ['label' => 'Accueil', 'icon' => 'home',  'url' => ['/site/index']];
        $menuItems2[] = ['label' => 'Clients', 'icon' => 'users',  'url' => ['/customerMarket/customer']];
        $menuItems2[] = ['label' => 'Marchés', 'icon' => 'shopping-cart',  'url' => ['/customerMarket/market']];
        $menuItems2[] = ['label' => 'Bons de commande', 'icon' => 'file-text',  'url' => ['/site/']];
        $menuItems2[] = ['label' => 'Project', 'icon' => 'bars',  'url' => ['/project/project/'],
                        'items'=>[ 
                            ['label' => 'Project Technique', 'url'=>Url::toRoute(['/project/project/view-projects','type'=>'technique'])],
                            ['label' => 'Project Adm/struct', 'url'=>Url::toRoute(['/project/project/view-projects', 'type'=>'adm_struct'])],
                            ['label' => '<span class="pull-right badge">10</span> New Arrivals', 'url'=>Url::toRoute(['/project/project/view-projects', 'type'=>'adm'])]
                        ]
            ];
        $menuItems2[] = ['label' => 'Reunions', 'icon' => 'calendar-o',  'url' => ['/meeting/meeting/']];
    
        if(!Yii::$app->user->identity->role == 'admin'){
           $menuItems2[] = ['label' => 'Comptes util.', 'icon' => 'user',  'url' => ['/site/']]; 
        }
        
        $menuItems2[] = ['label' => 'Forum', 'icon' => 'pencil-square',  'url' => ['/publication/publication'],
                        'items'=>[
                            ['label'=>'Idées', 'icon'=>'ideas', 'url'=>Url::toRoute(['/publication/publication/view-pubs','nature'=>'idee' ]) ],           
                            ['label'=>'Suggestions', 'icon'=>'Suggestions', 'url'=>Url::toRoute(['/publication/publication/view-pubs', 'nature'=>'suggestion'])] 
                         ]
            ];
    }
    $type = SideNav::TYPE_PRIMARY;
 // $item='home';
$options2 = [
    'type' => $type,
    'encodeLabels' => false,
    'iconPrefix'=>'fa fa-',
     'options' => [
            'class' => ' navbar-left ',
            'style'=> 'color:white'
        ],
    'heading' => '<img class="img-circle" src="uploads/seinova.png" style="width:30%"><span class="1first_title" style="font-size:16px"> SEINOVA</span>',
    'headingOptions'=>[ 'class'=>'site_title',
        'style'=>'background-color: #2A3F54; color:white; '
        . 'height:100%; border:0px solid black'],
     'items' => $menuItems2
];
?>
<!-- begin wrap div. This div contains all the menus and page content -->
<div class="wrap" style="background-color: white">
    <?php
        NavBar::begin([
          //  'brandLabel' => 'Seinova',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [ 'class' => ' navbar-fixed-top','style'=> 'background-color: #EDEDED' ],
        ]);

        echo Nav::widget(['options' => ['class' => 'navbar-nav navbar-right '], 'items' => $menuItems, ]);
        NavBar::end();
    ?>
    <div class="container" style="margin-left: 0px; padding-left:0px"><!-- begins container, this div contains sideNav and body -->
      <div class='row'>
        <div id="" class="  col-md-2 col-lg-2 col-xs-2" style="position: fixed; top:0; z-index: 1040; height: 100%; margin-top: 0px; margin-left: 0px; margin-right: 0px;  background-color: #2A3F54; color: white ">
           <div class="collapse navbar-collapse" id="sidenav">
                <?= SideNav::widget($options2); ?>
           </div>  
       </div>  
      
        <div class='col-md-10 col-lg-10 col-xs-10 col-md-offset-2 col-lg-offset-2 col-xs-offset-2'>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="" id="#mainContainer">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>   
        </div>
     </div><!-- end row div -->
   </div><!-- end container div-->
 </div>   <!-- end wrap div -->
 
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
