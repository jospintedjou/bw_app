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

AppAsset::register($this);

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
   
        <!-- begin wrap div. This div contains all the menus and page content -->

        <div class="" >
            
            <div class="" style="width:100%"><!-- begins container, this div contains sideNav and body -->
                               
                <!-- class="right_col" role="main" -->
                <div class="" role="main">
                    <div class="">            
                            <?= Alert::widget() ?>
                            <?= $content ?>
                    </div>   
                    
                </div>
                
                <div class="row">
                    <footer style="background:#fff; padding:10px 10px " class="navbar-fixed-bottom" style="width:100%; margin-right: 0px;"  >

                        <div class=" col-sm-6 col-xs-9 col-xs-offset-0">&copy; BLACK&WHITE <?= date('Y') ?></div>
                        <div class=" col-sm-6 col-xs-9 col-xs-offset-0"> Powered by SEINOVA</div>
                     </footer>
                </div> 
              
            </div><!-- end main container-->
              
        </div>   <!-- end wrap div -->

        

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
