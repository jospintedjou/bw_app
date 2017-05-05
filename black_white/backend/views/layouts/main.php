<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;
//use kartik\sidenav\SideNav;
use backend\views\widgets\gentelellaSideNav\GentelellaSideNav;
use backend\views\widgets\gentelellaSideNav\GentelellaNavBar;
use yii\helpers\Url;
use common\providers\OurConnection;

AppAsset::register($this);

//$this->registerCssFile('css/libs/font-awesome.min.css');
//$this->registerCss('.child_menu > li > a{color:white; font-size:12px; margin-left:2px}');
//$this->registerCss("@media  screen and (min-width:500px) and (max-width:1280px){ footer{width:100%} }");

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="uploads/favicon-96x96.png" sizes="128x128" />
		<meta name="theme-color" content="red"><?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php
        $this->head();
        ?>
    </head>
    <body class="nav-md">
        <?php $this->beginBody(); ?>
        <?php        
        /** Declaration of $menuItems, the array of navBar items * */
        $menuItems = [
                // ['label' => 'Home', 'url' => ['/site/index']],
                // ['label' => 'About', 'url' => ['/site/about']],
                // ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $appType = (new OurConnection())->getDb()->type;
            $appName = ucFirst((new OurConnection())->getDb()->name);
           
            $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                            'Déconnexion (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
                    )
                    . Html::endForm()
                    . '</li>';
        }


        /** Declaration of $menuItems2, the array of gentelellasideNav items * */
        if (Yii::$app->user->isGuest) {
            $menuItems2[] = [];
            $menuItems[] = [];
            $options2 = ['type'=>GentelellaSideNav::TYPE_DEFAULT, 'items' =>[]];
            //  $menuItems[] = ['label' => 'Connexion','icon'=>'users', 'url' => ['/site/login']];
        } else {
            
            $menuItems2[] = ['label' => 'Accueil', 'icon' => 'home', 'url' => ['/site/home'], 'active' => \Yii::$app->controller->id == 'site'];
            if (Yii::$app->user->identity->role == 'DG' || Yii::$app->user->identity->role == 'GS') {
                $menuItems2[] = ['label' => 'Comptes', 'icon' => 'users', 'url' => ['/accounts/account/view-accounts']];
                
                if($appType=='succursale'){
                $menuItems2[] = [ 'label' => 'Gestion des stocks Succ', 'icon' => 'shopping-cart',
                    'items' => [
                       [ 'active'=>\Yii::$app->controller->id=='branch-stock' && $this->context->action->id=='view',
                            'label' => 'Consulter', 'url' => Url::toRoute(['/stocks/branch-stock/view'])],
                       [ 'active'=>\Yii::$app->controller->id=='branch-stock'&& $this->context->action->id=='view' ,
                            'label' => 'Entrées en stock', 'url' => Url::toRoute(['/stocks/branch-stock/view'])],
                        [ 'active' => \Yii::$app->controller->id == 'branch-stock' && $this->context->action->id == 'order-product',
                            'label' => 'Commander au magasin', 'url' => Url::toRoute(['/stocks/branch-stock/order-product'])],
                        [ 'active'=>\Yii::$app->controller->id=='branch-stock'&& $this->context->action->id=='view' ,
                            'label' => 'Historique', 'url' => Url::toRoute(['/stocks/branch-stock/view'])],
                       
                       
                   
                    ] 
                     ];
                }else if($appType=='magasin'){
                    $menuItems2[] = [ 'label' => 'Gestion des stocks Mag', 'icon' => 'shopping-cart',
                    'items' => [
                       [ 'active'=>\Yii::$app->controller->id=='warehouse' && $this->context->action->id=='view',
                            'label' => 'Consulter', 'url' => Url::toRoute(['/stocks/warehouse/view'])],
                       ['active'=>\Yii::$app->controller->id=='warehouse' && $this->context->action->id=='view',
                           'label' => 'entrées en stock', 'url' => Url::toRoute(['/stocks/warehouse/index'])],
                       ['active'=>\Yii::$app->controller->id=='warehouse'  && $this->context->action->id=='view',
                           'label' => 'sorties de stock', 'url' => Url::toRoute(['/stocks/warehouse/index'])],
                       ['active'=>\Yii::$app->controller->id=='warehouse'  && $this->context->action->id=='view',
                           'label' => 'Historique', 'url' => Url::toRoute(['/stocks/warehouse/index'])],
                       
                   
                    ] 
                     ];
                }
                 
                //$menuItems2[] = ['label' => 'Marchés', 'icon' => 'shopping-cart', 'url' => ['/customerMarket/market/view-markets', 'active' => \Yii::$app->controller->id == 'view-markets']];
                
                 $menuItems2[] = ['label' => 'Livraison', 'icon' => 'truck', 'url' => ['/stocks/branch-stock/index'],];
            
            
                $menuItems2[] = [ 'label' => 'statistiques', 'icon' => 'bars', 'url' => ['/statistics/statistics/index'],
                                 'items' => [
                                     ['active'=>\Yii::$app->controller->id=='statistics', 'label' => 'recap. des ventes', 'url' => Url::toRoute(['/statistics/statistics/index'])],
                                     
                                  ]
                                ];

          }
        
        $type = GentelellaSideNav::TYPE_DEFAULT;
        $picture = (new yii\db\Query)->select('p.nom')->from('user u')
                                     ->innerJoin('photo p', 'p.id_photo=u.id_photo')
                                     ->where(['u.id' => Yii::$app->user->identity->id])->scalar();
        // $item='home';
        $options2 = [
            'type' => $type,
            'encodeLabels' => false,
            'iconPrefix' => 'fa fa-',
            'options' => [
                'class' => 'nav side-menu',
                //'style' => 'color:white'
            ],
            'picturePath'=>'../../backend/web/uploads/'.$picture,
            'username'=>Yii::$app->user->identity->prenom,
            'heading' => '',
            
           'headingOptions' => [  ],
            'items' => $menuItems2
        ];
        }
    ?>
        <!-- begin wrap div. This div contains all the menus and page content -->

        <div class="container body wrap" >
            
            <div class="main_container" style="width:100%"><!-- begins container, this div contains sideNav and body -->
                
                <div id="" class="col-md-3 col-xs-12 left_col" >
                        <?= GentelellaSideNav::widget($options2); ?>
                </div>  

                <div class='top_nav ' >
                  <div class='nav_menu col-xs-12' style="width:">
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        //echo $appName ? '<span style="margin-left:40%; height:50%;width:50%">Vous êtes connecté à '.$appName.'</span>' : '';
                        GentelellaNavBar::begin([
                            'brandLabel' => '<div id="menu_toggle" class="" style="color:#fff; font-size:1.5em"><i class="fa fa-bars"></i></div>',
                            'brandUrl' => Yii::$app->homeUrl,
                            'brandOptions'=>['style'=>'background:'],
                            'options' => [ 'class' => '', 'style' => ''],
                            'containerOptions' => [ 'class' => '', 'style' => '', 'id'=>'a'],
                        ]);

                    echo Nav::widget(['options' => ['class' => 'nav navbar-nav navbar-right', 'style'=>''], 'items' => $menuItems,]);
                    
                    GentelellaNavBar::end();
                    } else {
                       //$this->registerCss(".right_col{'margin-top: px; position:absolute'; top:-100px}");
                   }
                   ?>
                       
                  </div>
                </div>
                
                <!-- class="right_col" role="main" -->
                <div class="right_col" role="main" style="min-height: 704px;">
                    <div class="" style="margin-top: 5%">
                        <div style="padding-left:35%; font-size:20px; color:#73879C; background-color: #ededed">Vous êtes connecté à <?= $appName?> </div>
                    <?php
//                        Breadcrumbs::widget([
//                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//                        ])
                        ?>
                            
                            <?= Alert::widget() ?>
                            <?= $content ?>
                    </div>   
                    
                </div>
                        <footer style="z-index:-1;background:#fff; padding:15px 15px;" class="footer nav row" >

                            <div class=" col-sm-5 col-xs-5 col-xs-offset-0">&copy; BLACK&WHITE <?= date('Y') ?></div>
                            <div class=" col-sm-5 col-xs-5 col-xs-offset-0"> Powered by SEINOVA</div>
                            <div class="clearfix hidden-xs hidden-sm"></div>

                        </footer> 
              
            </div><!-- end main container-->
              
        </div>   <!-- end wrap div -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
