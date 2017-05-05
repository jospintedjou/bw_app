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
		<link rel="icon" type="image/png" href="uploads/favicon-96x96.png" sizes="128x128" />
		<meta name="theme-color" content="red"><?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php
        $this->head();
        $this->registerCss(".panel-info{border: 0px}");
        $this->registerCss(".navbar-left li  {font-size:1.1em; color: #E7E7E7;margin: 30px 0px 0px; background-color: #2A3F54; border: 0px solid white}");
        $this->registerCss(".navbar-left li a {font-size:1em; color: #E7E7E7;margin: 20px 0px 0px ;padding: 10px 0px 0px ; background-color: #2A3F54; border: 0px solid white}");

        $this->registerCss(".navbar-left li  ul li a {font-size:0.9em; background-color: #2A3F54;margin: 0px 0px 0px ;padding: 10px 0px 0px ; border: 0px solid white}");
        $this->registerCss(".navbar-left li  ul  li{background-color: #2A3F54;margin: 0px 0px 0px ;padding: 0px 0px 0px ; border: 0px solid white}");
        $this->registerCss(".panel {background-color: #2A3F54; border: 0px solid white}");
        $this->registerCss(".first_title {background-color: ; border: 0px solid white; font-weight:400; font-size:15px} ");
        $this->registerCss("#firstLi a {font-size:1em; color: #E7E7E7;padding: 0px 2px 0px 0px; margin:25px 0px 0px; background-color: #2A3F54; border: 0px solid white}");
        $this->registerCss(".navbar-left li a:hover {font-size:1em; background-color: #3f4b55 }");
        // $this->registerCss( "#w0-collapse {height:50em}" );
        $this->registerCss(".fa{font-size: 1.3em;}");
        $this->registerCss(".right_col{ position: relative; margin-top:0}");
        $this->registerCss("#nbNewComments, #nbNewCommentsIdeas, #nbNewCommentsSuggs{ background-color:orange }");
        //$this->registerJs("$('.panel-title').addClass('site_title')");
        // $this->registerCss( ".left_col{ position: relative; margin-top:5%}" );
        ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <?php
        /** Declaration of $menuItems, the array of navBar items * */
        $menuItems = [
                // ['label' => 'Home', 'url' => ['/site/index']],
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
                            'Déconnexion (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
                    )
                    . Html::endForm()
                    . '</li>';
        }


        /** Declaration of $menuItems2, the array of sideNav items * */
        if (Yii::$app->user->isGuest) {
            $menuItems2[] = [];
            //  $menuItems[] = ['label' => 'Connexion','icon'=>'users', 'url' => ['/site/login']];
        } else {
            //$picture = (new yii\db\Query)->select('f.nom nom_fich')->from('user u')->leftJoin('fichier f', 'f.id_user=u.id')->where(['f.type' => 'photo', 'f.id_user' => Yii::$app->user->identity->id])->scalar();
            //$menuItems2[] = ['label' => '<div class="row"><div class="col-md-6" style"display:inline-block"><img src="../../backend/web/uploads/' . $picture . '"id="ProfImg" class="img-circle profile_img" style="width:90%; height:4em; margin:2px" /></div><div class="col-md-6" style="display:inline-block; line-height: 20px"> Bienvenu  ' . Yii::$app->user->identity->prenom . '</div></div>', 'url' => '#', 'options' => ['style' => 'padding:0px; margin: 0px ', 'id' => 'firstLi']];
            $menuItems2[] = ['label' => 'Accueil', 'icon' => 'home', 'url' => ['/site/index'], 'active' => \Yii::$app->controller->id == 'site'];

            $menuItems2[] = ['label' => 'Clients', 'icon' => 'users', 'url' => ['/customerMarket/customer/view-customers'], 'active' => \Yii::$app->controller->id == 'customer'];
            if (true) {
                 $menuItems2[] = ['label' => 'Marchés', 'icon' => 'shopping-cart', 'url' => ['/customerMarket/market/view-markets', 'type' => 'prive'],
                    'items' => [
                        ['label' => 'Marchés Privés', 'url' => Url::toRoute(['/customerMarket/market/view-markets', 'type' => 'prive']), 'active' => (\Yii::$app->controller->action->id == 'view-markets')&& \Yii::$app->controller->actionParams['type'] == 'prive'],
                        ['label' => 'Marchés Publics', 'url' => Url::toRoute(['/customerMarket/market/view-markets', 'type' => 'public']), 'active' => (\Yii::$app->controller->action->id == 'view-markets' ) && \Yii::$app->controller->actionParams['type'] == 'public'],
                   
                    ] 
                     ];
                 
                //$menuItems2[] = ['label' => 'Marchés', 'icon' => 'shopping-cart', 'url' => ['/customerMarket/market/view-markets', 'active' => \Yii::$app->controller->id == 'view-markets']];
                
                 $menuItems2[] = ['label' => 'Bons de commande', 'icon' => 'file-text', 'url' => ['/purchaseOrder/purchase-order/view-orders'],];
            }
            if (true) {
                $menuItems2[] = ['label' => 'Projets', 'icon' => 'bars', 'url' => ['/project/project/view-projects'],
                    'items' => [
                        ['label' => 'Projets Tech.', 'url' => Url::toRoute(['/project/project/view-projects', 'type' => 'technique']), 'active' => (\Yii::$app->controller->action->id == 'view-projects' || \Yii::$app->controller->action->id == 'view-details' ) && \Yii::$app->controller->actionParams['type'] == 'technique'],
                        ['label' => 'Projets Adm/struct', 'url' => Url::toRoute(['/project/project/view-projects', 'type' => 'adm_struct']), 'active' => (\Yii::$app->controller->action->id == 'view-projects' || \Yii::$app->controller->action->id == 'view-details' ) && \Yii::$app->controller->actionParams['type'] == 'adm_struct'],
                    //['label' => '<span class="pull-right badge">10</span> New Arrivals', 'url'=>Url::toRoute(['/project/project/view-projects', 'type'=>'adm'])]
                    ]
                ];
            } else

            if (true) {
                $menuItems2[] = ['label' => 'Projets Techniques', 'icon' => 'bars', 'url' => Url::toRoute(['/project/project/view-projects', 'type' => 'technique']), 'active' => (\Yii::$app->controller->action->id == 'view-projects' || \Yii::$app->controller->action->id == 'view-details' ) && \Yii::$app->controller->actionParams['type'] == 'technique'];
            };

            $menuItems2[] = ['label' => 'Réunions <span class="badge bg-green pull-right" id="ndMeeting"></span>', 'icon' => 'calendar-o', 'url' => ['/meeting/meeting/view-meetings']];

            if (true) {

                $menuItems2[] = ['label' => 'Comptes util.', 'icon' => 'user', 'url' => ['/site/']];
            }

            $menuItems2[] = ['label' => '<span id="nbNewPubls" class="pull-right badge"></span><span id="nbNewComments" class=" pull-right badge"></span>Forum', 'icon' => 'pencil-square', 'url' => ['/site/'],
                'items' => [
                    ['label' => '<span id="nbNewIdeas" class="pull-right badge"></span><span id="nbNewCommentsIdeas" class=" pull-right badge"></span>Idées', 'icon' => 'ideas', 'url' => Url::toRoute(['/publication/publication/view-pubs', 'nature' => 'idee']), 'active' => (\Yii::$app->controller->action->id == 'view-pubs' || \Yii::$app->controller->action->id == 'view-comments' ) && \Yii::$app->controller->actionParams['nature'] == 'idee'],
                    ['label' => '<span id="nbNewSuggestions" class="pull-right badge"></span><span id="nbNewCommentsSuggs" class=" pull-right badge"></span><span id="suggText">Suggestions</span>', 'icon' => 'Suggestions', 'url' => Url::toRoute(['/publication/publication/view-pubs', 'nature' => 'suggestion']), 'active' => (\Yii::$app->controller->action->id == 'view-pubs' || \Yii::$app->controller->action->id == 'view-comments' ) && \Yii::$app->controller->actionParams['nature'] == 'suggestion']
                ]
            ];
        }
        $type = SideNav::TYPE_DEFAULT;
        // $item='home';
        $options2 = [
            'type' => $type,
            'encodeLabels' => false,
            'iconPrefix' => 'fa fa-',
            'options' => [
                'class' => ' navbar-left ',
                'style' => 'color:white'
            ],
            'heading' => '<img class="img-circle" src="uploads/seinova.png" style="width:20%; height: 25px"><span class="1first_title" style="font-size:23px; font-weight: bold; line-height:5px"> SEINOVA</span>',
            'headingOptions' => [ 'class' => 'site_title',
                'style' => 'background-color: #2A3F54; color:white; '
                . 'height:100%; border:0px solid black'],
            'items' => $menuItems2
        ];
        ?>
        <!-- begin wrap div. This div contains all the menus and page content -->

        <div class="wrap" style="background-color: white">
            <?php
            if (!Yii::$app->user->isGuest) {
                NavBar::begin([
                    // 'brandLabel' => 'Seinova',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [ 'class' => ' navbar-fixed-top', 'style' => 'background-color: #EDEDED; height:0.2%'],
                ]);

                echo Nav::widget(['options' => ['class' => 'navbar-nav navbar-right '], 'items' => $menuItems,]);
                NavBar::end();
            } else {
                $this->registerCss(".right_col{'margin-top: px; position:absolute'; top:-100px}");
            }
            ?>
            <div class="container" style="margin-left: 0px; padding-left:0px; padding-top:40px"><!-- begins container, this div contains sideNav and body -->
                <div class='row'>
                    <div id="" class="col-md-2 col-lg-2 col-xs-2" style="position: fixed; top:0; z-index: 1040; height: 100%; margin-top: 0px; margin-left: 0px; margin-right: 0px;  background-color: #2A3F54; color: white ">
                        <div class="collapse navbar-collapse" id="sidenav">
                            <?= SideNav::widget($options2); ?>
                        </div>  
                    </div>  

                    <div class='col-md-10 col-lg-10 col-xs-10 col-md-offset-2 col-lg-offset-2 col-xs-offset-2'>
                        <?php
                        Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])
                        ?>
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
                <p class="pull-left">&copy; SEINOVA SARL <?= date('Y') ?></p>

                <p class="pull-right"> Powered by SEINOVA Dev Team</p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
